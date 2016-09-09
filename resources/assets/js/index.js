var Hazard = require('./elements/hazards');
var Drop = require('tether-drop');
Hazard.init();
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
});

var axios = require('./axios');
var functions = require('./ajax_functions');
var accident = require('./templates/accident_template');
var hazard = require('./templates/hazard_template');

var $ = require('jquery');
$('body').on('submit', '.add-form', function(event) {
  event.preventDefault();
  var form = $(event.currentTarget);
  var activity = form.data("add");
  var activity_name = activity + '-name';
  var name = form.find("#" + activity_name).val();
  // Verifies if activity is accident
  if (activity === 'accident') {
    var $newAccident = $('#accidents').find(".substep__list");
    axios.post('/addaccident', {
      name: name,
      id : 4
    })
    .then(function (response) { 
      console.log(response);
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
      id : 4
    })
    .then(function(response) {
      console.log(response);
      $newHazard.append(hazard(response.data));
    })
    .catch(function(error) {
      console.log(error);
    })
  }
  //
  else if (activity === 'component') {

  }
  return false;
});
