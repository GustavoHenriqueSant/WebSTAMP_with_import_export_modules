var Hazard = require('./elements/hazards');
var State = require('./elements/states');
var ControlActions = require('./elements/controlactions');
var Drop = require('tether-drop');
Hazard.init();
State.init();
ControlActions.init();
var fundamentals = ['hazard', 'component', 'systemgoal', 'accident', 'controlaction', 'variable', 'state'];

fundamentals.forEach(function(f) {
  var drop = new Drop({
    target: document.querySelector('[data-add="' + f + '"]'),
    content: document.querySelector('[data-drop="' + f + '"]'),
    openOn: 'click',
    tetherOptions: {
      attachment: 'top left',
      targetAttachment: 'middle right',
      constraints: [
        {
          to: 'scrollParent',
          attachment: 'together'
        }
      ]
    }
  });
  drop.on("open", function() {
    if (f === "hazard"){
      Hazard.showAccidents();
    }
  })
  drop.on("open", function() {
    if (f === "state"){
      State.showVariables();
    }
  })
  drop.on("open", function() {
    if (f === "controlaction"){
      ControlActions.showControllers();
    }
  })
});

var axios = require('./axios');
var functions = require('./ajax_functions');

var systemgoal = require('./templates/systemgoal_template');
var accident = require('./templates/accident_template');
var hazard = require('./templates/hazard_template');
var component = require('./templates/component_template');
var controlaction = require('./templates/controlaction_template');
var variable = require('./templates/variable_template');
var state = require('./templates/state_template');

var $ = require('jquery');
$('body').on('submit', '.add-form', function(event) {
  event.preventDefault();
  var form = $(event.currentTarget);
  var activity = form.data("add");
  var activity_name = activity + '-name';
  var name = form.find("#" + activity_name).val();
  var id = 0;
  // Verifies if activity is system goal
  if (activity === 'systemgoal') {
  	var $newSystemGoal = $('#systemgoals').find(".substep__list");
    axios.post('/addsystemgoal', {
      name: name,
      id : id
    })
    .then(function (response) { 
      $newSystemGoal.append(systemgoal(response.data));
    })
    .catch(function (error) {
      console.log(error);
    });
  }
  // Verifies if activity is accident
  else if (activity === 'accident') {
    var $newAccident = $('#accidents').find(".substep__list");
    axios.post('/addaccident', {
      name: name,
      id : id
    })
    .then(function (response) { 
      Hazard.addAccident(response.data);
      $newAccident.append(accident(response.data));
    })
    .catch(function (error) {
      console.log(error);
    });
  // Verify if activity is hazard
  } else if (activity === 'hazard') { 
    var $newHazard = $('#hazards').find(".substep__list");
    axios.post('/addhazard', {
      name : name,
      id : id
    })
    .then(function(response) {
      $newHazard.append(hazard(response.data));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  // Verify if activity is component
  else if (activity === 'component') {
  	var type = form.find("#component-type").val();
  	var $newComponent = $('#components').find(".substep__list");
  	axios.post('/addcomponent', {
      name : name,
      type : type,
      id : id
    })
    .then(function(response) {
      if (type === 'Controller') {
      	ControlActions.addController(response.data);
      }
      $newComponent.append(component(response.data));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  // Verify if activity is control control action
  else if (activity === 'controlaction'){
  	var component_id = form.find("#controller-association").val();
  	var t = form.find("#variable-association").val();
  	var controller_name = form.find("#controller-association option:selected").text();
  	var $newControlAction = $('#controlactions').find(".substep__list");
  	axios.post('/addcontrolaction', {
      name : name,
      component_id : component_id,
      controller_name : controller_name,
      id : id
    })
    .then(function(response) {
    	$newControlAction.append(controlaction(response.data, controller_name));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  // Verify if activity is variable
  else if (activity === 'variable') {
  	var $newVariable = $('#variables').find(".substep__list");
    axios.post('/addvariable', {
      name : name,
      id : id
    })
    .then(function(response) {
      State.addVariable(response.data);
      $newVariable.append(variable(response.data));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  // Verify if activity is state
  else if (activity === 'state') {
  	var variable_id = form.find("#variable-association").val();
  	var variable_name = form.find("#variable-association option:selected").text();
  	var $newState = $('#states').find(".substep__list");
    axios.post('/addstate', {
      name : name,
      variable_id : variable_id,
      variable_name : variable_name,
      id : id
    })
    .then(function(response) {
      $newState.append(state(response.data, variable_name));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  return false;
});

$('body').on('submit', '.delete-form', function(event) {
  event.preventDefault();
  var form = $(event.currentTarget);
  axios.post('/deleteaccident', {
      id : id,
      name: "oi"
    })
    .then(function (response) {
      $("#accident-6").remove();
    })
    .catch(function (error) {
      console.log(error);
    })
    return false;
  });