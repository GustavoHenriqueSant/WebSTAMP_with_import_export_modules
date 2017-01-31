var actualPage = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

if (actualPage != 'stepone') {
  var $ = require('jquery');

  var Hazard = require('./elements/hazards');
  //var State = require('./elements/states');
  var ControlActions = require('./elements/controlactions');
  var Drop = require('tether-drop');

  var vex = require('vex-js');
  vex.registerPlugin(require('vex-dialog'));
  vex.defaultOptions.className = 'vex-theme-os';

  Hazard.init();
  //State.init();
  ControlActions.init();
  var fundamentals = ['hazard', 'component', 'systemgoal', 'accident', 'systemsafetyconstraint', 'variable-0'];
  $('.variables-content').each(function(index, f){
    fundamentals.push(f.id);
  })
  $('.controlactions-content').each(function(index, f){
    fundamentals.push(f.id);
  })
  $('.connections-content').each(function(index, f){
    fundamentals.push(f.id);
  })
  $('.item__actions__add').each(function(index, f){
    fundamentals.push(f.id);
  })
  fundamentals.forEach(function(f) {
    var drop = new Drop({
      target: document.querySelector('[data-add="' + f + '"]'),
      content: document.querySelector('[data-drop="' + f + '"]'),
      openOn: 'click',
      remove: true,
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

  var systemgoal = require('./templates/systemgoal_template');
  var accident = require('./templates/accident_template');
  var hazard = require('./templates/hazard_template');
  var actuator = require('./templates/actuator_template');
  var controlledprocess = require('./templates/controlledprocess_template');
  var sensor = require('./templates/sensor_template');
  var component = require('./templates/component_template');
  var connection = require('./templates/connection_template');
  var controlaction = require('./templates/controlaction_template');
  var variable = require('./templates/variable_template');
  var accident = require('./templates/connection_template');
  var state = require('./templates/state_template');
  var addstate = require('./templates/add-state_template');
  var systemsafetyconstraint = require('./templates/systemsafetyconstraint_template');


  // ADD

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
      var accidents_associated = form.find("#hazard-accident-association").val();
      var $newHazard = $('#hazards').find(".substep__list");
      var accidents_associated_id;
      axios.post('/addhazard', {
        name : name,
        id : id,
        accidents_associated : accidents_associated,
        accidents_associated_id : accidents_associated_id
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
      if (type === 'Actuator') {
        var $newComponent = $('#actuators');
        axios.post('/addactuator', {
          name : name,
          type : type,
          id : id
        })
        .then(function(response) {
          location.reload();
        })
        .catch(function(error) {
          console.log(error);
        })
      } else if (type === 'ControlledProcess') {
        var $newComponent = $('#controlledprocess');
        axios.post('/addcontrolledprocess', {
          name : name,
          id : id
        })
        .then(function(response) {
          location.reload();
        })
        .catch(function(error) {
          console.log(error);
        })
      } else if (type === "Controller") { 
        var $newComponent = $('#controllers');
        axios.post('/addcontroller', {
          name : name,
          id : id
        })
        .then(function(response) {
          location.reload();
        })
        .catch(function(error) {
          console.log(error);
        })
      } else if (type === "Sensor"){
        var $newComponent = $('#sensors');
        axios.post('/addsensor', {
          name : name,
          id : id
        })
        .then(function(response) {
          location.reload();
        })
        .catch(function(error) {
          console.log(error);
        })
      }
    }
    // Verify if activity is control control action
    else if (activity.indexOf("controlaction") != -1){
    	var controller_id = activity.split("-")[1];
    	var $newControlAction = $('#controlactions_content-' + controller_id).find(".substep__list");
      var id = 0;
      var name = form.find("#controlaction-" + controller_id + "-name").val();
    	axios.post('/addcontrolaction', {
        name : name,
        controller_id : controller_id,
        id : id
      })
      .then(function(response) {
      	$newControlAction.append(controlaction(response.data));
      })
      .catch(function(error) {
        console.log(error);
      })
    }
    // Verify if activity is state
    else if (activity.indexOf("state") != -1) {
    	var variable_id = form.find("#variable_id").val();
      var name = form.find("#state-name-" + variable_id).val();
      var id = 0;
      axios.post('/addstate', {
        name : name,
        variable_id : variable_id,
        id : id
      })
      .then(function(response) {
        var $newState = $('#variable-' + response.data.variable_id).find(".states-associated");
        console.log($newState);
        $newState.append(state(response.data, true));
       $newState = $('.variable-' + response.data.variable_id).find(".states-associated");
        $newState.append(state(response.data, false));
      })
      .catch(function(error) {
        console.log(error);
      })
    }
    // Verify if activity is System Safety Constraint
    else if (activity === 'systemsafetyconstraint') {
      var $newSSC = $('#systemsafetyconstraint').find(".substep__list");
      axios.post('/addsystemsafetyconstraint', {
        name : name,
        id : id
      })
      .then(function(response) {
        $newSSC.append(systemsafetyconstraint(response.data));
      })
      .catch(function(error) {
        console.log(error);
      })
    }
    // Verify if activity is variable
    else if (activity.indexOf("connections") != -1){
      var type_output = activity.split("-")[1];
      var output_component_id = activity.split("-")[2];
      var output_name = form.find("#" + activity + " option:selected").text();
      var input_name = form.find('#component_name').val();
      var input = form.find("#" + activity + " option:selected").val();
      var type_input = input.split("-")[0];
      var input_component_id = input.split("-")[1];
      var id = 0;
      var $newConnection = $('#connection-' + type_output + '-' + output_component_id).find(".substep__list");
      axios.post('/addconnections', {
        input_component_id : input_component_id,
        type_input : type_input,
        input_name : input_name,
        output_component_id : output_component_id,
        type_output : type_output,
        output_name : output_name,
        id : id
      })
      .then(function(response) {
        $newConnection.append(connection(response.data));
      })
      .catch(function(error) {
        console.log(error);
      })

    }else {
      var variable_split = activity.split('-');
      var controller_id = 0;
      var $newVariable = "";
      var id = 0;
      if (variable_split.length > 2){
        controller_id = variable_split[2];
        $newVariable = $('#variables-' + controller_id).find(".controller_variable");
      }
      else
        $newVariable = $('#variables-0').find(".controller_variable");
      var name = form.find("#variable-" + controller_id + "-name").val();
      var states = [];
      form.find(".states-associated").each(function(index){
        states.push($(this).val());
      });
      axios.post('/addvariable', {
        name : name,
        id : id,
        controller_id : controller_id,
        states : states
      })
      .then(function(response) {
        if (response.data.controller_id > 0){
          $newVariable.append(variable(response.data, true));
          $('body').append(addstate(response.data));
          var state_variable = 'state-variable-' + response.data.id;
          var drop = new Drop({
            target: document.querySelector('[data-add="' + state_variable + '"]'),
            content: document.querySelector('[data-drop="form-' + state_variable + '"]'),
            openOn: 'click',
            remove: true,
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
        }
        else {
          $newVariable.append(variable(response.data, true));
          $('.variables-content').find(".substep__list").append(variable(response.data, false));
          $('body').append(addstate(response.data));
          var state_variable = 'state-variable-' + response.data.id;
          var drop = new Drop({
            target: document.querySelector('[data-add="' + state_variable + '"]'),
            content: document.querySelector('[data-drop="form-' + state_variable + '"]'),
            openOn: 'click',
            remove: true,
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

        }
      })
      .catch(function(error) {
        console.log(error);
      })
    }
    return false;
  });


  // DELETE

  $('body').on('submit', '.delete-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("delete");
    vex.dialog.confirm({
      message: 'Are you sure you want to delete this item?',
      callback: function (value) {
        if (value) {
          if (activity === 'accident'){
            var id = form.find("#accident_id").val();
            axios.post('/deleteaccident', {
                id : id,
              })
              .then(function (response) {
                $("#accident-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'systemgoal'){
            var id = form.find("#systemgoal_id").val();
            axios.post('/deletesystemgoal', {
                id : id,
              })
              .then(function (response) {
                $("#systemgoal-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'hazard') {
            var id = form.find("#hazard_id").val();
            axios.post('/deletehazard', {
                id : id,
              })
              .then(function (response) {
                $("#hazard-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'component') {
            var id = form.find("#component_id").val();
            var type = form.find("#component_type").val().toLowerCase();
            axios.post('/deletecomponent', {
                id : id,
              })
              .then(function (response) {
                $("#" + type + "-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'controlaction') {
            var id = form.find("#controlaction_id").val();
            axios.post('/deletecontrolaction', {
                id : id,
              })
              .then(function (response) {
                $("#controlaction-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          }
           else if (activity === 'systemsafetyconstraint') {
            var id = form.find("#systemsafetyconstraint_id").val();
            axios.post('/deletesystemsafetyconstraint', {
                id : id,
              })
              .then(function (response) {
                $("#systemsafetyconstraint-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'variable') {
            var id = form.find("#variable_id").val();
            axios.post('/deletevariable', {
                id : id,
              })
              .then(function (response) {
                $(".variable-" + id).remove();
                $("#variable-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'connection') {
            var id = form.find("#connection_id").val();
            axios.post('/deleteconnections', {
                id : id,
              })
              .then(function (response) {
                $("#connection-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          }
        }
      }
    });

    });



// FUNCTION TO EDIT FUNDAMENTALS

function edit_fundamentals(id, activity) {
  if (activity == "accident") {
    var name = $("#accident-description-"+id).val();
    axios.post('/editaccident', {
        id : id,
        name : name
      })
      .then(function (response) {
        $("#accident-description-" + id).replaceWith('<input type="text" class="item__input" id="accident-description-'+id+'" value="'+name+'" size="'+name.length+'" disabled>');
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
  } else if (activity == "hazard") {
    var name = $("#hazard-description-"+id).val();
    axios.post('/edithazard', {
        id : id,
        name : name
      })
      .then(function (response) {
        $("#hazard-description-" + id).replaceWith('<input type="text" class="item__input" id="hazard-description-'+id+'" value="'+name+'" size="'+name.length+'">');
        document.getElementById("hazard-description-" + id).disabled = true;
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
  } else if (activity == "systemgoal") {
    var name = $("#systemgoal-description-"+id).val();
    axios.post('/editsystemgoal', {
        id : id,
        name : name
      })
      .then(function (response) {
        $("#systemgoal-description-" + id).replaceWith('<input type="text" class="item__input" id="systemgoal-description-'+id+'" value="'+name+'" size="100">');
        document.getElementById("systemgoal-description-" + id).disabled = true;
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
  } else if (activity == "systemsafetyconstraint") {
    var name = $("#systemsafetyconstraint-description-"+id).val();
    axios.post('/editsystemsafetyconstraint', {
        id : id,
        name : name
      })
      .then(function (response) {
        $("#systemsafetyconstraint-description-" + id).replaceWith('<input type="text" class="item__input" id="systemsafetyconstraint-description-'+id+'" value="'+name+'" size="100">');
        document.getElementById("systemsafetyconstraint-description-" + id).disabled = true;
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
  } else if (activity == "variable") {
    var name = $("#variable-description-"+id).val();
    axios.post('/editvariable', {
        id : id,
        name : name
      })
      .then(function (response) {
        $('#state-variable-'+id).hide();
        $("#variable-description-" + id).replaceWith('<input type="text" class="item__input" id="variable-description-'+id+'" value="'+name+'" size="'+name.length+'">');
        document.getElementById("variable-description-" + id).className = "item__input";
        document.getElementById("variable-description-" + id).disabled = true;
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
    }
}

// EDIT WHEN INPUT LOSES FOCUS
$("body").on('blur', '.item__input__active', function(event) {
  event.preventDefault();
  var split = event.currentTarget.id.split("-");
  var id = split[2];
  var activity = split[0];
  edit_fundamentals(id, activity);
});

// EDIT WHEN KEY "ENTER" WAS PRESSED
$("body").on('keypress', '.item__input__active', function(event) {
  if (event.which == 13) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[2];
    var activity = split[0];
    edit_fundamentals(id, activity);
  }
});


  $('body').on('click', '.edit-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("edit");
    if (activity == "accident") {
      var id = form.find("#accident_id").val();
      $('#accident-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "hazard") {
      var id = form.find("#hazard_id").val();
      $('#hazard-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "systemgoal") {
      var id = form.find("#systemgoal_id").val();
      $('#systemgoal-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "systemsafetyconstraint") {
      var id = form.find("#systemsafetyconstraint_id").val();
      $('#systemsafetyconstraint-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "variable") {
      var id = form.find("#variable_id").val();
      $('#state-variable-'+id).show();
      $('#variable-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    }

  });

  $('.item__input').on('keyup', function(event) {
    event.currentTarget.size = event.currentTarget.value.length;
  });

  $('.item__input__active').on('keyup', function(event) {
    event.currentTarget.size = event.currentTarget.value.length;
  });

  $(window).load(function(event) {
    $('.item__input').each(function(){
      this.size = this.value.length;
    });
  });

  // DELETE BLUE ITEM -> ACCIDENT(HAZARD) AND VARIABLE(STATE))

  $('body').on('click', '.item__delete__box', function(event) {
    var id = $(event.currentTarget).data('index');
    var type = $(event.currentTarget).data('type');
    vex.dialog.confirm({
      message: 'Are you sure you want to delete this item?',
      callback: function (value) {
        if (value) {
          if (type === 'hazard'){
            axios.post('/deleteaccidentassociated', {
                id : id,
              })
              .then(function (response) {
                $("#accident-associated-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (type === 'variable'){
              axios.post('/deletestate', {
                  id : id,
                })
                .then(function (response) {
                  $(".state-associated-" + id).remove();
                  $("#state-associated-" + id).remove();
                })
                .catch(function (error) {
                  console.log(error);
                })
                return false;
            }
        }
      }
    });
  });

  $('body').on('click', '.accordion', function (event){
    var accordion = $(event.currentTarget);
    accordion.toggleClass('active');
    accordion.next().toggleClass('show');
  });

  $('body').on('change', '#component-type', function (event){
    var component_type = $(event.currentTarget).find(":selected").text();
    if (component_type !== "Controller"){
      $("#actuator-type").hide();
    } else {
      $("#actuator-type").show();
    }
  });

/*
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
*/
  // STEP 1
} else {
  // Require JQuery
  var $ = require('jquery');

  $(function() {
    // Get all elements with class step_one
    var $op1 = $('.hide-control-actions');

    // Verifies if there is Control Actions stored
    if ($op1 != null)
      // Show the first control action (with lower id)
      $($op1[0]).show();
  
  // function to hide all elements with class step_one
  var hideAll = function() {
    $op1.hide();
  };

  // Function to alter the visibility of the control action under analysis
  $('#control-actions-select').change(function(e) {
      // Hide all elements of all control actions
      hideAll();
      // Shows the content of selected control action
      $('#control-action-'+e.target.value).show();
  });

});

  var axios = require('./axios');

  $('body').on('submit', '.add-new-rule', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var controlaction_id = form.find("#controlaction_id").val();
    var $newRule = $('#rule-control-action-'+controlaction_id).find(".container-fluid");
    var rule_index = $('#rule-control-action-'+controlaction_id).find(".rules-ca-"+controlaction_id).length+1;
    var append = '<div class="table-row rules-ca-'+controlaction_id+'"><div class="text">R'+rule_index+'</div>';
    var variables = form.find('[id^="variable_id_"]').each(function() {
      var ids = form.find(this).val().split("-");
      var variable_id = ids[0];
      var state_id = ids[1];
      var name = $(this).find('option:selected').attr('name');
      append += '<div class="text">'+name+'</div>';
      var id = 0;
      axios.post('/addrule', {
        id : id,
        rule_index: rule_index,
        variable_id : variable_id,
        state_id : state_id,
        controlaction_id : controlaction_id
      })
      .catch(function (error) {
        console.log(error);
      });
    });
    append += '</div>';
    $newRule.append(append);  
  });

  console.log($('total_rows_0'));
}

