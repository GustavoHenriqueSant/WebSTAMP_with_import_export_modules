var actualPage = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

if (!actualPage.includes('stepone') && !actualPage.includes('steptwo')) {
  var $ = require('jquery');

  var Hazard = require('./elements/hazards');
  //var State = require('./elements/states');
  var ControlActions = require('./elements/controlactions');
  var Drop = require('tether-drop');

  var vex = require('vex-js');
  vex.registerPlugin(require('vex-dialog'));
  vex.defaultOptions.className = 'vex-theme-os';

  var axios = require('./axios');

  $('body').on('click', '#add-new-project', function(event){
    event.preventDefault();
    vex.closeAll();
    vex.open({
      // overlayClosesOnClick: false,
      unsafeContent: $("#add-project").html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
    });
  });

  $('body').on('submit', '.adding-project', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var name = form.find("#name").val();
    var description = form.find("#description").val();
    var type = form.find("#type").val();
    var shared = form.find("#user-email").val() + ";" + form.find("#shared").val();
    axios.post('/addproject', {
      name : name,
      description : description,
      type : type,
      shared : shared
    }).then(function (response) { 
        console.log(response);
        location.reload();
      })
      .catch(function (error) {
        console.log(error);
      });
  });

  $('body').on('submit', '.editing-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var id = form.find("#project_id").val();
    var name = form.find("#project_name").val();
    var description = form.find("#project_description").val();
    var shared = form.find("#user-email").val() + ";" + form.find("#shared").val();
    $('#edit-id').attr("value", id);
    $('#edit-name').attr("value", name);
    $("#edit-description").html(description);
    axios.post('/getteam', {
      id : id
    }).then(function(response) {
      var emails = ""; //response.data.team[0];
      for (var i = 1; i < response.data.team.length; i++) {
        emails += (i > 1) ? ";" + response.data.team[i] : response.data.team[i];
      }
      $('#edit-shared').attr("value", emails);
      setTimeout(function(){
        vex.closeAll();
        vex.open({
          // overlayClosesOnClick: false,
          unsafeContent: $("#edit-project").html(),
          buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
          ],
          showCloseButton: true,
          className: "vex-theme-default"
        });
      }, 100);
        
    }).catch(function(error) {
      console.log(error);
    });
  });

  $('body').on('submit', '.editing-project', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var id = form.find("#edit-id").val();
    var name = form.find("#edit-name").val();
    var description = form.find("#edit-description").val();
    axios.post('/editproject', {
      id : id,
      name : name,
      description : description
    }).then(function (response) { 
        console.log(response);
        location.reload();
      })
      .catch(function (error) {
        console.log(error);
      });
  });

  $('body').on('focusout', '#mission_purpose, #mission_purpose_edit', function (event) {
    event.preventDefault();
    var target = event.target.id;
    if (target == "mission_purpose") {
      var purpose = $(event.currentTarget).val();
      $(".label-mission-purpose").empty();
      $(".label-mission-purpose").append(purpose);
    } else {
      var purpose = $(event.currentTarget).text();
      $(".label-mission-purpose-edit").empty();
      $(".label-mission-purpose-edit").append(purpose);
    }
  });

  $('body').on('focusout', '#mission_method, #mission_method_edit', function (event) {
    event.preventDefault();
    var target = event.target.id;
    if (target == "mission_method") {
      var methods = $(event.currentTarget).val();
      var method = removeSemicolon(methods);
      $(".label-mission-method").empty();
      $(".label-mission-method").append(method);
    } else {
      var methods = $(event.currentTarget).text();
      var method = removeSemicolon(methods);
      $(".label-mission-method-edit").empty();
      $(".label-mission-method-edit").append(method);
    }
    
  });

  $('body').on('focusout', '#mission_goal, #mission_goal_edit', function (event) {
    event.preventDefault();
    var target = event.target.id;
    if (target == "mission_goal") {
      var goals = $(event.currentTarget).val();
      var goal = removeSemicolon(goals);
      $(".label-mission-goal").empty();
      $(".label-mission-goal").append(goal);
    } else {
      var goals = $(event.currentTarget).text();
      var goal = removeSemicolon(goals);
      $(".label-mission-goal-edit").empty();
      $(".label-mission-goal-edit").append(goal);
    }
  });

  $('body').on('submit', '.adding-mission-assurance', function (event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var mission_purpose = form.find("#mission_purpose").val();
    var mission_method = form.find('#mission_method').val();
    var mission_goal = form.find('#mission_goal').val();
    var project_id = form.find('#project_id').val();
    var id = 0;
    axios.post('/addmission', {
      id : id,
      purpose : mission_purpose,
      method : mission_method,
      goals : mission_goal,
      project_id : project_id
    })
    .catch(function (error) {
      console.log(error);
    });
    location.reload();
  });

  $('body').on('submit', '.editing-mission-assurance', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var id = form.find("#mission_id").val();
    var purpose = form.find("#mission_purpose_edit").html();
    $("#mission-purpose").val(purpose);
    var method = form.find("#mission_method_edit").html();
    $("#mission-method").val(method);
    var goal = form.find("#mission_goal_edit").html();
    $("#mission-goal").val(goal);
    axios.post('/editmission', {
        id : id,
        purpose : purpose,
        method : method,
        goals : goal
      })
    .then(function (response) {
      $(".label-for-mission-purpose").empty();
      $(".label-for-mission-purpose").html(purpose);
      $(".label-for-mission-method").empty();
      $(".label-for-mission-method").html(removeSemicolon(method));
      $(".label-for-mission-goal").empty();
      $(".label-for-mission-goal").html(removeSemicolon(goal));
      vex.closeAll();
    })
    .catch(function (error) {
      console.log(error);
    })
  });

  function removeSemicolon(parameter) {
    parameter = parameter.split(";");
    var result = "";
    var parameter_length = parameter.length;
    parameter.forEach(function(f, index) {
      if (index < parameter_length-2)
        result += " [" + f + "],";
      else if (index == parameter_length-2)
        result += " [" + f + "] and ";
      else
        result += " [" + f + "]";
    });
    result = result.split("[ ").join("[");
    return result;
  }

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
  var connection = require('./templates/connection_template');
  var state = require('./templates/state_template');
  var addstate = require('./templates/add-state_template');
  var systemsafetyconstraint = require('./templates/systemsafetyconstraint_template');

  
  function getLossesId(myString) {
    var myRegexp = /\[L\-\d+\]/g;
    var match = myRegexp.exec(myString);
    var str_return = "";
    var matches = [];
    while (match != null) {
      str_return += match[0];
      match = myRegexp.exec(myString);
      str_return += (match != null) ? "," : "";
    }
    myRegexp = /\d+/g;
    match = myRegexp.exec(str_return);
    str_return = "";
    while (match != null) {
      str_return += match[0];
      match = myRegexp.exec(myString);
      str_return += (match != null) ? "," : "";
    }
    return str_return;
  }

  // ADD

  $('body').on('submit', '.add-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("add");
    var activity_name = activity + '-name';
    var name = form.find("#" + activity_name).val();
    var project_id = $('#project_id').val();
    var id = 0;
    // Verifies if activity is system goal
    if (activity === 'systemgoal') {
      var $newSystemGoal = $('#systemgoals').find(".substep__list");
      axios.post('/addsystemgoal', {
        name: name,
        id : id,
        project_id : project_id
      })
      .then(function (response) {
        var exihibition_id = $('#systemgoals').find(".substep__list").children().length + 1; 
        $newSystemGoal.append(systemgoal(response.data, exihibition_id));
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
        id : id,
        project_id : project_id
      })
      .then(function (response) { 
        Hazard.addAccident(response.data);
        var exihibition_id = $('#accidents').find(".substep__list").children().length + 1;
        $newAccident.append(accident(response.data, exihibition_id));
      })
      .catch(function (error) {
        console.log(error);
      });
    // Verify if activity is hazard
    } else if (activity === 'hazard') { 
      var accidents_associated = form.find("#hazard-accident-association").val();
      var losses_id = getLossesId(form.find("#hazard-accident-association :selected").text()).split(",");
      var $newHazard = $('#hazards').find(".substep__list");
      var accidents_associated_id;
      var project_type = $('#project_type').val();
      axios.post('/addhazard', {
        name : name,
        id : id,
        accidents_associated : accidents_associated,
        accidents_associated_id : accidents_associated_id,
        project_id : project_id,
        project_type : project_type
      })
      .then(function(response) {
        var exihibition_id = $("#hazards_content").children().children().length + 1;
        $newHazard.append(hazard(response.data, exihibition_id, losses_id));
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
          id : id,
          project_id : project_id
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
          id : id,
          project_id : project_id
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
          id : id,
          project_id : project_id
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
          id : id,
          project_id : project_id
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
        id : id,
        project_id : project_id
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
        id : id,
        project_id : project_id
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
        id : id,
        project_id : project_id
      })
      .then(function(response) {
        var exihibition_id = $('#systemsafetyconstraint').find(".substep__list").children().length + 1;  
        $newSSC.append(systemsafetyconstraint(response.data, exihibition_id));
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
        id : id,
        project_id : project_id
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
        states : states,
        project_id : project_id
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
            var type = form.find("#component_type").val();
            if (type === 'actuator') {
              axios.post('/deleteactuator', {
                id : id,
              })
              .then(function (response) {
                $("#" + type + "-" + id).remove();
                $("#panel-" + type + "-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
            } else if (type === 'controlledprocess') {
              axios.post('/deletecontrolledprocess', {
                id : id,
              })
              .then(function (response) {
                $("#" + type + "-" + id).remove();
                $("#panel-" + type + "-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
            } else if (type === 'controller') {
              axios.post('/deletecontroller', {
                id : id,
              })
              .then(function (response) {
                $("#" + type + "-" + id).remove();
                $("#panel-" + type + "-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
            } else if (type === 'sensor') {
              axios.post('/deletesensor', {
                id : id,
              })
              .then(function (response) {
                $("#" + type + "-" + id).remove();
                $("#panel-" + type + "-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
            }
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


// Mission Assurance
$('body').on('click', '#editing-mission', function(event){
    event.preventDefault();
    var form = $(event.currentTarget);
    $("#mission_purpose_edit").html($("#mission-purpose").val());
    $("#mission_method_edit").html($("#mission-method").val());
    $("#mission_goal_edit").html($("#mission-goal").val());
    $("#mission_id").val(form.find("#mission_id").val());
    $(".label-mission-purpose-edit").html($(".label-for-mission-purpose").html());
    $(".label-mission-method-edit").html($(".label-for-mission-method").html());
    $(".label-mission-goal-edit").html($(".label-for-mission-goal").html());
    vex.open({
      unsafeContent: $("#edit-mission-assurance").html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
    });
    });

  

$('body').on('click', '.add-mission-assurance', function(event){
    event.preventDefault();
    vex.open({
      unsafeContent: $("#add-a-new-mission-assurance").html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
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
    } else if(activity == "actuator"){
      var name = $("#actuator-description-"+id).val();
      axios.post('/editactuator', {
        id : id,
        name : name
      })
      .then(function(response) {
        $("#actuator-description-" + id).replaceWith('<input type="text" class="item__input" id="actuator-description-'+id+'" value="'+name+'" size="100">');
        $("#actuator-" + id).replaceWith('<button class="accordion" id="actuator-' + id + '"><b>[Actuator]</b> ' + name + '</button>');
        document.getElementById("actuator-description-" + id).disabled = true;
      })
      } else if(activity == "controlledprocess"){
        var name = $("#controlledprocess-description-"+id).val();
        axios.post('/editcontrolledprocess', {
          id : id,
          name : name
        })
        .then(function(response) {
          $("#controlledprocess-description-" + id).replaceWith('<input type="text" class="item__input" id="controlledprocess-description-'+id+'" value="'+name+'" size="100">');
          $("#controlledprocess-" + id).replaceWith('<button class="accordion" id="controlledprocess-' + id + '"><b>[Controlled Process]</b> ' + name + '</button>');
          document.getElementById("controlledprocess-description-" + id).disabled = true;
        })
    } else if(activity == "controller"){
        var name = $("#controller-description-"+id).val();
        axios.post('/editcontroller', {
          id : id,
          name : name
        })
        .then(function(response) {
          $("#controller-description-" + id).replaceWith('<input type="text" class="item__input" id="controller-description-'+id+'" value="'+name+'" size="100">');
          $("#controller-" + id).replaceWith('<button class="accordion" id="controller-' + id + '"><b>[Controller]</b> ' + name + '</button>');
          document.getElementById("controller-description-" + id).disabled = true;
        })
    } else if(activity == "sensor"){
      var name = $("#sensor-description-"+id).val();
      axios.post('/editsensor', {
        id : id,
        name : name
      })
      .then(function(response) {
        $("#sensor-description-" + id).replaceWith('<input type="text" class="item__input" id="sensor-description-'+id+'" value="'+name+'" size="100">');
        $("#sensor-" + id).replaceWith('<button class="accordion" id="sensor-' + id + '"><b>[Sensor]</b> ' + name + '</button>');
        document.getElementById("sensor-description-" + id).disabled = true;
      })
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
    } else if (activity == "actuator"){
      var id = form.find("#actuator_id").val();
      $('#actuator-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "controlledprocess"){
      console.log("alo");
      var id = form.find("#controlledprocess_id").val();
      $('#controlledprocess-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "controller"){
      var id = form.find("#controller_id").val();
      $('#controller-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "actuator") {
      var id = form.find("#actuator_id").val();
      $('#actuator-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "controlledprocess") {
      var id = form.find("#controlledprocess_id").val();
      $('#controlledprocess-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "controller") {
      var id = form.find("#controller_id").val();
      $('#controller-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else if (activity == "sensor") {
      var id = form.find("#sensor_id").val();
      $('#sensor-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
      return false;
    } else {}

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
} else if(!actualPage.includes('steptwo')) {
  // Require JQuery
  var $ = require('jquery');

  var axios = require('./axios');

  var Drop = require('tether-drop');

  var vex = require('vex-js');
  vex.registerPlugin(require('vex-dialog'));
  vex.defaultOptions.className = 'vex-theme-os';

  var UCA = require('./templates/unsafecontrolaction_template');

  var uca = [];

  // $('.item__input').on('keyup', function(event) {
  //   event.currentTarget.size = event.currentTarget.value.length;
  // });

  // $('.item__input__active').on('keyup', function(event) {
  //   event.currentTarget.size = event.currentTarget.value.length;
  // });

  // $(window).load(function(event) {
  //   $('.item__input').each(function(){
  //     this.size = this.value.length;
  //   });
  // });

  $('textarea').on('keyup change onpaste', function () {
    var alturaScroll = this.scrollHeight;
    var alturaCaixa = $(this).height();

    if (alturaScroll > (alturaCaixa + 10)) {
        if (alturaScroll > 500) return;
        $(this).css('height', alturaScroll);
    }

    if( $(this).val() == '' ){
        // retonando ao height padrão de 40px
        $(this).css('height', '40px');
    }
  });

  $("body").on('blur', '.uca_list_textarea', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    $("#type-"+id).attr('class', 'type-combo');
    edit_uca_sc(id);
  });

  $("body").on('change', '.item__input__active', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    $("#type-"+id).attr('class', 'type-combo');
    edit_uca_sc(id);
  });

  // EDIT WHEN KEY "ENTER" WAS PRESSED
  $("body").on('keypress', '.uca_list_textarea', function(event) {
    if (event.which == 13) {
      event.preventDefault();
      var split = event.currentTarget.id.split("-");
      var id = split[2];
      var activity = split[0];
      edit_uca_sc(id, activity);
    }
  });

  $("body").on('change', '.type-combo', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    edit_causal_analysis(id);
  });


  function edit_uca_sc(id) {
    var unsafe_control_action = $("#unsafe_control_action-" + id).val();
    var type = $("#type-" + id + " option:selected").val();
    var safety_constraint = $("#safety_constraint-" + id).val();
    axios.post('/edituca', {
      id : id,
      unsafe_control_action : unsafe_control_action,
      type : type,
      safety_constraint : safety_constraint
    })
    .then(function(response) {
      $("#unsafe_control_action-"+id).prop('disabled', true);
      $("#type-"+id).prop('disabled', true);
      $("#safety_constraint-"+id).prop('disabled', true);
    })
    .catch(function(error) {
      console.log(error);
    })
  }


  $('.add-uca').each(function(index, f){
    uca.push(f.id);
  })
  uca.forEach(function(f) {
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
  });

  function convertType(type){
    if (type == "provided")
      return "Provided";
    else if (type == "not provided")
      return "Not provided";
    else if (type == "wrong time")
      return "Provided in wrong order";
    else if (type == "wrong order")
      return "Provided in wrong order";
    else if (type == "too early")
      return "Provided too early";
    else if (type == "too late")
      return "Provided too late";
    else if (type == "too soon")
      return "Stopped too soon";
    else if (type == "too long")
      return "Applied too long";
  }


  $('body').on('click', '.add-new-uca', function(event){
    event.preventDefault();
    $(".unsafe-control").each(function(){
      $(this).html("");
    });
    $(".safety-control").each(function(){
      $(this).html("");
    });
    var form = $(event.currentTarget);
    var controlaction_id = form.attr("id").split("-")[1];
    vex.closeAll();
    vex.open({
      unsafeContent: $("#add-new-uca-" + controlaction_id).html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
    });
  });

  $('body').on('click', '.suggested-uca', function(event){
    event.preventDefault();
    var form = $(event.currentTarget);
    var controlaction_id = form.attr("id").split("-")[2];
    var controlaction_name = $("#controlaction_name_"+controlaction_id).val();
    var controller_name = $("#controller_name_"+controlaction_id).val();
    console.log(controlaction_name);
    var total_rows = $('#total_rows').val() - 1;
    var possible_uca = [];
    var causal_id = 0;
    while (total_rows >= 0) {
      var states = $("#all_states_" + total_rows).val();
      var provided = $("#provided-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var not_provided = $("#notprovided-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var wrong_time = $("#wrongtime-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var early = $("#early-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var late = $("#late-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var soon = $("#soon-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      var long = $("#long-ca-" + controlaction_id + "-row-" + total_rows + ":enabled").val();
      
      if (provided == "true"){
        possible_uca.push([controlaction_id, states,"provided"]);
      }
      if (not_provided == "true"){
        possible_uca.push([controlaction_id, states,"not provided"]);
      }
      if (wrong_time == "true"){
        possible_uca.push([controlaction_id, states,"wrong time"]);
      }
      if (early == "true"){
        possible_uca.push([controlaction_id, states,"too early"]);
      }
      if (late == "true"){
        possible_uca.push([controlaction_id, states,"too late"]);
      }
      if (soon == "true"){
        possible_uca.push([controlaction_id, states,"too soon"]);
      }
      if (long == "true"){
        possible_uca.push([controlaction_id, states,"too long"]);
      }
      total_rows--;
    }
    var formulario = $("#add-suggested-uca-" + controlaction_id);
    formulario.find("#suggested-content-"+controlaction_id).html("");
    var states = [];
    possible_uca.forEach(function f(index){
      var type = index[2];
      states = index[1].split(",");
      var context = states;
      var estados = [];
      states.forEach(function f(state_id, index) {
        estados[index] = getVariableName(state_id) + " is " + getStateName(state_id);
      }); 
      var UCA_Text = generateUCAText(controlaction_id, controller_name, controlaction_name, index[2], estados);
      states = [];
      estados = [];
      formulario.find("#suggested-content-"+controlaction_id).append('<div class="table-row"><div class="text" id="uca-'+causal_id+'">'+ UCA_Text.unsafe_control_action +'.</div><div class="text" id="sc-'+causal_id+'">'+ UCA_Text.safety_constraint +'.</div><div class="content-uca center"><input type="checkbox" style="display: inline-block; height: 100%; vertical-align: middle;" class="associated-checkbox" id="checkbox-'+causal_id+'"><input type="hidden" id="context-'+causal_id+'" value="'+context+'"/><input type="hidden" id="type-'+causal_id+'" value="'+type+'"/></div></div>');
      causal_id++;
  });
    vex.closeAll();
    vex.open({
      // overlayClosesOnClick: false,
      unsafeContent: $("#add-suggested-uca-" + controlaction_id).html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
    });
  });

  function getVariableName(id){
    var new_id = $("#associated-variable-id-" + id).val();
    return $("#varible-name-id-" + new_id).val();
  }


  function getStateName(id){
    return $("#name-state-id-" + id).val();
  }

  $('body').on('click', '.legend-button', function(event){
    event.preventDefault();
    vex.closeAll();
    vex.open({
      unsafeContent: $(".legend-contexttable").html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      className: "vex-theme-default"
    });
  });

  $(window).load(function(event) {
    // Getting the total rows of the Context Table
    var total_rows = $("#total_rows").val();
    // Control Actions with problems
    var control_actions = [];
    var t = [];
    // For each .text_error, stores the number of the row
    $('.text_error').each(function(){
      control_actions.push(this.id.split("-")[2]);
      var c = {row:total_rows-this.id.split("-")[4], ca_id:this.id.split("-")[2]};
      t.push(c);
    });
    // Removes the repeated elements of the CA
    var ca_without_repetition = control_actions.filter(function(elem, pos, self) {
      return self.indexOf(elem) == pos;
    })
    ca_without_repetition.forEach(function(ca_id){
      // Array that stores the lines with problem (with class "text_error")
      var lines_with_problem = [];
      var lines_without_repetition = [];
      t.forEach(function(elem) {
        if (elem.ca_id == ca_id)
          lines_with_problem.push(elem.row);
          // Removes the repeated elements of the rows
          lines_without_repetition = lines_with_problem.filter(function(elem, pos, self) {
            return self.indexOf(elem) == pos;
          })
      });
      $("#warning-message-ca-" + ca_id).html("Warning: An error occured on saving the data. Please, revise the following row(s): [" + lines_without_repetition + "]").show();
    });
    //$("#warning-message-ca-" + ca_id).html("Warning: An error occured on saving the data. Please, revise the following row(s): [" + uniqueArray + "]").show();
    // $("#warning-message-ca-" + ca_id).
  });

  $(window).load(function(event) {
    $('.item__input').each(function(){
      this.size = this.value.length;
    });
  });

  $('body').on('submit', '.adding-uca', function(event) {
    event.preventDefault();
    vex.closeAll();
    var form = $(event.currentTarget);
    var controlaction_id = form.find("#controlaction_id").val();
    var controller_name = form.find("#controller_name").val();
    var controlaction_name = form.find("#controlaction_name").val();
    var type = "";
    form.find(".associated-checkbox:checked").each(function(index, f){
      var id = 0;
      var checkbox_id = f.id.split("-")[1];
      var unsafe_control_action = form.find("#uca-"+checkbox_id).text();
      var safety_constraint = form.find("#sc-"+checkbox_id).text();
      var context = form.find("#context-"+checkbox_id).val();
      var type = form.find("#type-"+checkbox_id).val();
      type = convertType(type);
      var rule_id = 0;
      axios.post('/adduca', {
        id : id,
        unsafe_control_action : unsafe_control_action,
        safety_constraint : safety_constraint,
        type : type,
        controlaction_id : controlaction_id,
        rule_id : rule_id,
        context : context
      })
      .then(function (response) {
        $("#uca-" + controlaction_id).find(".container-fluid").append(UCA(response.data));
      })
      .catch(function (error) {
        console.log(error);
      })
    });
  });

  function generateUCAText(controlaction_id, controller_name, controlaction_name, type, states_name) {
    var unsafe_control_action = "";
    var safety_constraint = "";
    if (type.includes("too late") || type.includes("too soon") || type.includes("too early") || type.includes("too long")){
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " " + type.toLowerCase() + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " " + type.toLowerCase() + " when";
    } else if (type.includes("wrong time") || type.includes("wrong order")){
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " in " + type.toLowerCase() + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " in " + type.toLowerCase() + " when";
    } else{
      unsafe_control_action = controller_name.toLowerCase() + " " + type.toLowerCase() + " " + controlaction_name.toLowerCase() + " when";
      if (type.includes("not provided")){
        safety_constraint = controller_name.toLowerCase() + " must provide " + controlaction_name.toLowerCase() + " when";
      } else {
        safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " when";
      }
    }
    unsafe_control_action = unsafe_control_action[0].toUpperCase() + unsafe_control_action.slice(1);
    safety_constraint = safety_constraint[0].toUpperCase() + safety_constraint.slice(1);
    var states_size = states_name.length;
    states_name.forEach(function(f, index) {
      if (index != states_size - 1){
        unsafe_control_action += ", " + f.toLowerCase();
        safety_constraint += ", " + f.toLowerCase();
      }
      else{
        unsafe_control_action += " and " + f.toLowerCase();
        safety_constraint += " and " + f.toLowerCase();
      }
    })
    unsafe_control_action = unsafe_control_action.replace("when and", "when");
    unsafe_control_action = unsafe_control_action.replace("when,", "when");
    safety_constraint = safety_constraint.replace("when and", "when");
    safety_constraint = safety_constraint.replace("when,", "when");
    return {unsafe_control_action: unsafe_control_action, safety_constraint: safety_constraint};
  }

  $('body').on('change', '.mudanca', function(event) {
    var form = $(event.currentTarget).closest(".adding-manual-uca");
    var controlaction_id = form.find("#controlaction_id").val();
    var controller_name = form.find("#controller_name").val();
    var controlaction_name = form.find("#controlaction_name").val();
    var type = "";
    $(".type-uca").each(function(index, f){
      if (index > 0 && f.id.split("-")[2] == controlaction_id){
        type = $(f).find("option:selected").val();         
      }
    });
    var states = [];
    var states_name = [];
    $(".uca-row-" + controlaction_id + " option:selected").each(function(index, f){
      if (f.value.split("-")[0] > 0){
        states.push(f.value.split("-")[0]);
        states_name.push(f.value.split("-")[1] + " is " + f.text);
      }
    })
    var unsafe_control_action = "";
    var safety_constraint = "";
    if (type.includes("too late") || type.includes("too soon") || type.includes("too early") || type.includes("too long")){
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " " + type.toLowerCase() + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " " + type.toLowerCase() + " when";
    } else if (type.includes("wrong time") || type.includes("wrong order")){
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " in " + type.toLowerCase() + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " in " + type.toLowerCase() + " when";
    } else{
      unsafe_control_action = controller_name.toLowerCase() + " " + type.toLowerCase() + " " + controlaction_name.toLowerCase() + " when";
      if (type.includes("not provided")){
        safety_constraint = controller_name.toLowerCase() + " must provide " + controlaction_name.toLowerCase() + " when";
      } else {
        safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " when";
      }
    }
    unsafe_control_action = unsafe_control_action[0].toUpperCase() + unsafe_control_action.slice(1);
    safety_constraint = safety_constraint[0].toUpperCase() + safety_constraint.slice(1);
    var states_size = states_name.length;
    states_name.forEach(function(f, index) {
      if (index != states_size - 1){
        unsafe_control_action += ", " + f.toLowerCase();
        safety_constraint += ", " + f.toLowerCase();
      }
      else{
        unsafe_control_action += " and " + f.toLowerCase();
        safety_constraint += " and " + f.toLowerCase();
      }
    })
    unsafe_control_action = unsafe_control_action.replace("when and", "when");
    unsafe_control_action = unsafe_control_action.replace("when,", "when");
    safety_constraint = safety_constraint.replace("when and", "when");
    safety_constraint = safety_constraint.replace("when,", "when");
    if(states_name.length > 0){
      $(".unsafe-control").html("<br/><center><b>Potentially unsafe control action:</b></center><br/><span class='unsafe-control-name'>" + unsafe_control_action + "</span>.");
      $(".safety-control").html("<br/><center><b>Associated safety constraint:</b></center><br/><span class='safety-control-name'>" + safety_constraint + "</span>.");
    }
    console.log(controlaction_id);
    $(".adding-manual-uca").find("#context").val(states.join(",")); //.val();
  });

  // Add UCA and Safety Constraint Associated
  $('body').on('submit', '.adding-manual-uca', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    console.log(form);
    var controlaction_id = form.find("#controlaction_id").val();
    var unsafe_control_action = form.find(".unsafe-control-name").html();
    var safety_constraint = form.find(".safety-control-name").html();
    var type = form.find("#type-uca-" + controlaction_id + " option:selected").val();
    var context = form.find("#context").val();
    // Rule_is is always zero when the analyst add it.
    var rule_id = 0;
    var id = 0;
    console.log("CA: " + controlaction_id + " UCA: " + unsafe_control_action + " SC: " + safety_constraint + " Type: " + type + " Context: " + context);
    axios.post('/adduca', {
      id : id,
      unsafe_control_action : unsafe_control_action,
      safety_constraint : safety_constraint,
      type : type,
      controlaction_id : controlaction_id,
      context : context,
      rule_id : rule_id
    })
    .then(function (response) {
      $("#uca-" + controlaction_id).find(".container-fluid").append(UCA(response.data));
      vex.closeAll();
    })
    .catch(function (error) {
      console.log(error);
    })
  });

  $('body').on('click', '.edit-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("edit");
    var controlaction_id = form.find("#controlaction_id").val();
    var safety_constraint_id = form.find("#safety_constraint_id").val();
    if (activity === "uca") {
      $('#unsafe_control_action-'+safety_constraint_id).prop('disabled', false);
      $('#type-'+safety_constraint_id).attr('class', 'item__input__active').prop('disabled', false);
      $('#safety_constraint-'+safety_constraint_id).prop('disabled', false);
    }
  });

  $(function() {
    // Get all elements with class step_one
    var $op1 = $('.hide-control-actions');

    // Verifies if there is Control Actions stored
    if ($op1 != null) {
      //
      var ca_id = window.location.search.substr(1).split("=");
      if (ca_id[1] > 0) {
        // Show the selected rule
        $('#control-action-'+ca_id[1]).show();
        // Show the selected control action
        $('#control-actions-select').val(ca_id[1]);
      } else {
        // Show the first control action (with lower id)
        $($op1[0]).show();
      }
    }
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
      var ca_id = window.location.search.substr(1).split("=");
  });

});
  $('body').on('submit', '.delete-all-uca', function(event) {
    event.preventDefault();
    vex.dialog.confirm({
      message: 'All Hazardous Control Actions and Constraints will be deleted. All unsaved data will be lost. Are you sure?',
      callback: function (value) {
        if (value) {
          var form = $(event.currentTarget);
          var controlaction_id = form.find("#controlaction_id").val();
          axios.post('/deletealluca', {
            controlaction_id : controlaction_id
          }).catch(function (error) {
                console.log(error);
          });
          setTimeout(function(){
            var ca = window.location.search.substr(1).split("=");
            console.log(ca);
            if (ca.length > 1){
              var currentURL = window.location.href.split("?");
              window.location.href = currentURL[0] + '?ca='+controlaction_id;
            }
            else{
              window.location.href += '?ca='+controlaction_id;
            } 
          }, 2000);
        }
      }
    });
  })

  $('body').on('submit', '.delete-all-rules', function(event) {
    event.preventDefault();
    vex.dialog.confirm({
      message: 'All rules will be deleted. All unsaved data will be lost. Are you sure?',
      callback: function (value) {
        if (value) {
          var form = $(event.currentTarget);
          var controlaction_id = form.find("#controlaction_id").val();
          axios.post('/deleteallrules', {
            controlaction_id : controlaction_id
          }).catch(function (error) {
                console.log(error);
          });
          setTimeout(function(){
            var ca = window.location.search.substr(1).split("=");
            console.log(ca);
            if (ca.length > 1){
              var currentURL = window.location.href.split("?");
              window.location.href = currentURL[0] + '?ca='+controlaction_id;
            }
            else{
              window.location.href += '?ca='+controlaction_id;
            } 
          }, 2000);
        }
      }
    });
  })

  // Add rules
  $('body').on('submit', '.add-new-rule', function(event) {
    event.preventDefault();
    vex.dialog.confirm({
      message: 'Add a new rule implies on refresh the page. All unsaved data will be lost.  Are you sure?',
      callback: function (value) {
        if (value) {
          var form = $(event.currentTarget);
          var controlaction_id = form.find("#controlaction_id").val();
          var controlaction_name = $("#controlaction_name_"+controlaction_id).val();
          var controller_name = $("#controller_name_"+controlaction_id).val();
          var $newRule = $('#rule-control-action-'+controlaction_id).find(".container-fluid");
          var rule_index = $('#rule-control-action-'+controlaction_id).find(".rules-table").length+1;
          var column = "";
          var columns = form.find("#rule_column").val();
          for (var i=0; i < columns.length; i++) {
            column += (i < columns.length-1) ? columns[i] + ";" : columns[i];
          }
          var append = '<div class="table-row rules-table rules-ca-'+controlaction_id+'-rule-'+rule_index+'"><div class="text">R'+rule_index+'</div>';
          var variables_array = [];
          var states_name = [];
          var id = 0;
          var states_final = []
          var rule_id = 1;
          // Save each variable of the rule
          var variables = form.find('[id^="variable_id_"]').each(function() {
            var ids = form.find(this).val().split("-");
            var variable_id = ids[0];
            var state_id = ids[1];
            if (state_id > 0)
              variables_array.push(state_id);
            var name = $(this).find('option:selected').attr('name');
            //variables_array.forEach(function f(state_id, index){
              //states_final.push(getVariableName(state_id) + " is " + getStateName(state_id));
            //});
            console.log(name);
            if (name !== "ANY")
              states_final.push(getVariableName(state_id) + " is " + getStateName(state_id));
              //states_name.push(name);
            append += '<div class="text">'+name+'</div>';
            if (rule_index > 0)
            axios.post('/addrule', {
                id : id,
                rule_index: rule_index,
                variable_id : variable_id,
                state_id : state_id,
                controlaction_id : controlaction_id,
                column : column
            })
            .catch(function (error) {
                console.log(error);
            });
          });
          var column_index = -1;
          columns.forEach(function(column_name) {
            var sc = generateUCAText(controlaction_id, controller_name, controlaction_name, column_name, states_final);
            var context = "";
            variables_array.forEach(function(f, index) {
              console.log(f);
              if (index == 0)
                context += f;
              else if (index < variables_array.length)
                context += "," + f;
            })
            column_index++;
            axios.post('/adduca', {
              id : id,
              unsafe_control_action : sc.unsafe_control_action,
              safety_constraint : sc.safety_constraint,
              type : columns[column_index],
              controlaction_id : controlaction_id,
              rule_id : rule_id,
              context : context
            })
            .catch(function (error) {
              console.log(error);
            })
          });
          setTimeout(function(){
            var ca = window.location.search.substr(1).split("=");
            console.log(ca);
            if (ca.length > 1){
              var currentURL = window.location.href.split("?");
              window.location.href = currentURL[0] + '?ca='+controlaction_id;
            }
            else{
              window.location.href += '?ca='+controlaction_id;
            } 
          }, 2000);

          append += '<div class="text">' +
                        '<form action="/deleterule" class="delete-form" data-delete="rules" method="POST">' +
                            '<input type="hidden" name="_token" value="{{csrf_token()}}">' +
                            '<input type="hidden" name="controlaction_id" id="controlaction_id" value="' + controlaction_id + '">' +
                            '<input type="hidden" name="rule_index" id="rule_index" value="' + rule_index + '">' +
                            '<input type="image" src="/images/delete.ico" alt="Delete" width="20" class="navbar__logo">' +
                        '</form>' +
                    '</div>';
          append += '</div>';
      }
    }  
  });
});


  // DELETE RULES AND UCA/SC
  $('body').on('submit', '.delete-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("delete");
    vex.dialog.confirm({
      message: 'Are you sure you want to delete this item?',
      callback: function (value) {
        if (value) {
          if(activity == 'rules'){
            var rule_index = form.find("#rule_index").val();
            var controlaction_id = form.find('#controlaction_id').val();
            axios.post('/deleterule', {
                rule_index : rule_index,
                controlaction_id : controlaction_id
              })
              .then(function (response) {
                $(".rules-ca-" + controlaction_id + "-rule-" + rule_index).remove();
                location.reload();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else {
            var id = form.find("#safety_constraint_id").val();
            axios.post('/deleteuca', {
              id : id
            })
            .then(function(response) {
              $("#uca-row-" + id).remove();
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

  $('body').on('submit', '.clear-context-table', function(event) {
    event.preventDefault();
    vex.dialog.confirm({
      message: 'Attention: The Context Table is going to be cleaned (Not saved). If you want to save the cleaned Context table, use the "Save Context Table" Button. Are you sure you want to clean?.',
      callback: function (value) {
        if (value) {
          var form = $(event.currentTarget);
          var total_rows = form.find("#total_rows").val() - 1;
          var row = 0;
          var controlaction_id = form.find("#controlaction_id").val();
          while (total_rows >= 0) { //.is(':disabled')
            if (!$("#provided-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#provided-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            if (!$("#notprovided-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#notprovided-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            $("#wrongtime-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            if (!$("#early-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#early-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            if (!$("#late-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#late-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            if (!$("#soon-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#soon-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            if (!$("#long-ca-" + controlaction_id + "-row-" + total_rows).is(':disabled'))
              $("#long-ca-" + controlaction_id + "-row-" + total_rows).val("null");
            total_rows--;
          }
        }
      }
    });
  });

  $('body').on('submit', '.save-context-table', function(event) {
    event.preventDefault();
    vex.dialog.alert("Saving data, please wait...");
    var form = $(event.currentTarget);
    var controlaction_id = form.find("#controlaction_id").val();
    var total_rows = form.find("#total_rows").val() - 1;
    axios.post('/deletecontexttable', {
      controlaction_id : controlaction_id
    })
    .catch(function (error) {
      console.log(error);
    });
    var row = 0;
    var max_row = total_rows;
    while (total_rows >= 0) {
      var states = form.find("#all_states_" + total_rows).val();
      var provided = form.find("#provided-ca-" + controlaction_id + "-row-" + total_rows).val();
      var not_provided = form.find("#notprovided-ca-" + controlaction_id + "-row-" + total_rows).val();
      var wrong_time = form.find("#wrongtime-ca-" + controlaction_id + "-row-" + total_rows).val();
      var early = form.find("#early-ca-" + controlaction_id + "-row-" + total_rows).val();
      var late = form.find("#late-ca-" + controlaction_id + "-row-" + total_rows).val();
      var soon = form.find("#soon-ca-" + controlaction_id + "-row-" + total_rows).val();
      var long = form.find("#long-ca-" + controlaction_id + "-row-" + total_rows).val();
      axios.post('/savecontexttable', {
            controlaction_id : controlaction_id,
            states : states,
            provided : provided,
            not_provided: not_provided,
            wrong_time : wrong_time,
            early : early,
            late : late,
            soon : soon,
            long : long
        })
      .then(function(response){
        row++;
        console.log(row);
        if (row == max_row){
          vex.closeAll();
          vex.dialog.alert("Context table successfully saved");
        }
      })
      .catch(function (error) {
        console.log(error);
      });
      total_rows--;
    }
    // Hide the warning message
    $("#warning-message-ca-"+controlaction_id).hide();
    // Paint in white the yellow selectors
    form.find(".text_error").removeClass("text_error").addClass("text");    
  });

} else {





  // Require JQuery
  var $ = require('jquery');

  // Require axios
  var axios = require('./axios');

  var newCausal = require('./templates/causal_template');

  var vex = require('vex-js');
  vex.registerPlugin(require('vex-dialog'));
  vex.defaultOptions.className = 'vex-theme-default';

  $('body').on('submit', '.delete-all-tuple', function(event) {
    event.preventDefault();
    vex.dialog.confirm({
      message: 'All tuples created (through "Template Instantiation" and "Add new 4-tuple") for that HCA will be deleted. Are you sure?',
      callback: function (value) {
        if (value) {
          var form = $(event.currentTarget);
          var uca_id = form.find("#uca_id").val();
          var content = form.find(".table-content");
          axios.post('/deletealltuple', {
            uca_id : uca_id
          })
          .then(function(response){
            console.log(uca_id);
            $("#content-safety-"+uca_id).empty();
          })
          .catch(function (error) {
            console.log(error);
          })
        }
      }
    });
  });

  $('body').on('submit', '.adding-tuple', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var scenario = form.find("#scenario").val();
    var associated = form.find("#associated").val();
    var requirement = form.find("#requirement").val();
    var role = form.find("#role").val();
    var rationale = form.find("#rationale").val();
    var guideword = form.find("#guideword option:selected").val();
    var safety = form.find("#uca").val();
    var id = 0;
    axios.post('/addtuple', {
      id, id,
      scenario : scenario,
      associated : associated,
      requirement : requirement,
      role : role,
      rationale : rationale,
      guideword : guideword,
      safety : safety
    })
    .then(function(response){
      $("#safety-"+safety).find(".information-lifecycle").show();
      $("#safety-"+safety).find(".information-lifecycle").css('display', 'inline-block');
      $("#safety-"+safety).find(".table-content").append(newCausal(response.data));
      setTimeout(function(){
        vex.closeAll();
      }, 2000);
    })
    .catch(function (error) {
      console.log(error);
    })
  });

  $('body').on('submit', '.delete-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var id = form.find("#causal_id").val();
    vex.dialog.confirm({
      message: 'Are you sure you want to delete this item?',
      callback: function (value) {
        if (value && id > 0) {
          axios.post('/deletetuple', {
            id : id
          })
          .then(function(response) {
            $("#causal-row-" + id).remove();
          })
          .catch(function(error) {
            console.log(error);
          })
        }
      }
    }); 
  });

  $('body').on('submit', '.edit-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var id = form.find("#causal_id").val();
    // Disabling the textarea
    $("#guideword-"+id).prop('disabled', false);
    $("#scenario-"+id).prop('disabled', false);
    $("#associated-"+id).prop('disabled', false);
    $("#requirement-"+id).prop('disabled', false);
    $("#role-"+id).prop('disabled', false);
    $("#rationale-"+id).prop('disabled', false);
  });

  $("body").on('blur', '.step2_textarea', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    edit_causal_analysis(id);
  });

  $("body").on('change', '.guideword-combo', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    edit_causal_analysis(id);
  });

  // EDIT WHEN KEY "ENTER" WAS PRESSED
  $("body").on('keypress', '.step2_textarea', function(event) {
    if (event.which == 13) {
      event.preventDefault();
      var split = event.currentTarget.id.split("-");
      var id = split[1];
      var activity = split[0];
      edit_causal_analysis(id);
    }
  });

  function edit_causal_analysis(id){
    var guideword = $("#guideword-"+id+" option:selected").val(); 
    var scenario = $("#scenario-"+id).val();
    var associated = $("#associated-"+id).val();
    var requirement = $("#requirement-"+id).val();
    var role = $("#role-"+id).val();
    var rationale = $("#rationale-"+id).val();
    axios.post('/edittuple', {
      id : id,
      guideword : guideword,
      scenario : scenario,
      associated : associated,
      requirement : requirement,
      role : role,
      rationale : rationale
    })
    .then(function(response){
      $("#guideword-"+id).prop('disabled', true);
      $("#scenario-"+id).prop('disabled', true);
      $("#associated-"+id).prop('disabled', true);
      $("#requirement-"+id).prop('disabled', true);
      $("#role-"+id).prop('disabled', true);
      $("#rationale-"+id).prop('disabled', true);
    })
    .catch(function(error){
      console.log(error)
    })

  }

  $('body').on('click', '.teste-vex', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    // Gets the id of the UCA
    var value = form.data("id");
    console.log($("#table-left-" + value));
    $("#table-right" + value).show();
    $("#table-left-" + value).hide();
    // Change de hidden value to the actual UCA id
    $("#approach-"+value).find("#uca").val(value);
    vex.open({
      unsafeContent: $("#approach-"+value).html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      contentClassName: 'teste1'
    });
  });

  $('body').on('click', '.information-lifecycle', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    // Gets the id of the UCA
    var value = form.data("id");
    $("#information-"+value).find("#uca").val(value);
    vex.open({
      unsafeContent: $("#information-"+value).html(),
      buttons: [
        $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
        $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      showCloseButton: true,
      contentClassName: 'teste1'
    });
  });

  $('body').on('click', '.test-vex', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    // Gets the id of the UCA
    var value = form.data("id");
    // Gets the UCA
    var UCA = $("#uca_name_" + value).val();
    // Gets the Guide Question
    var GQ = $("#GQ_" + value).val();
    // Change de hidden value to the actual UCA id
    $("#add-tuple").find("#uca").val(value);
    // Put the UCA text on the <span>
    $('#4tupleUCA').html(UCA);
    // Put the UCA text on the <span>
    $('#4tupleGQ').html(GQ);
    //Opens the modal
    vex.open({
      unsafeContent: $("#add-tuple").html()
    });
  });
  
  $('textarea').on('keyup change onpaste', function () {
    var alturaScroll = this.scrollHeight;
    var alturaCaixa = $(this).height();

    if (alturaScroll > (alturaCaixa + 10)) {
        if (alturaScroll > 500) return;
        $(this).css('height', alturaScroll);
    }

    if( $(this).val() == '' ){
        // retonando ao height padrão de 40px
        $(this).css('height', '40px');
    }
  });


  $('body').on('submit', ".add-causal", function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var checked = [];
    form.find(".associated-checkbox:checked").each(function(index, f){
      var causal_id = f.id.split("-")[1];
      // console.log(causal_id);
      form.find("#guideword-scenario-" + causal_id).remove(".listing-guidewords");
      var scenario = form.find("#getting-scenario-" + causal_id).text().trim();
      var associated = form.find("#guideword-associated-" + causal_id).text().trim();
      var requirement = form.find("#guideword-requirement-" + causal_id).text().trim();
      var role = form.find("#guideword-role-" + causal_id).text().trim();
      var rationale = form.find("#guideword-rationale-" + causal_id).text().trim();
      var guideword = form.find("#guideword-" + causal_id).val().trim();
      var safety = form.find("#uca").val().trim();
      // console.log(scenario + "/" + associated + "/" + requirement + "/" + role + "/" + rationale + "/" + guideword + "/" + safety);
      console.log("UCA: " + safety);
      var id = 0;
      axios.post('/addtuple', {
        id, id,
        scenario : scenario,
        associated : associated,
        requirement : requirement,
        role : role,
        rationale : rationale,
        guideword : guideword,
        safety : safety
      })
      .then(function(response){
        $("#safety-"+safety).find(".information-lifecycle").show();
        $("#safety-"+safety).find(".information-lifecycle").css('display', 'inline-block');
        $("#safety-"+safety).find(".information-lifecycle").show();
        var guideword_id_information = (guideword == 13 || guideword == 14) ? 15 : guideword;
        guideword_id_information = (guideword == 18) ? 17 : guideword; 
        $("#information-"+safety).find(".guideword-"+guideword).show();
        $("#safety-"+safety).find("#content-safety-"+safety).append(newCausal(response.data));
        setTimeout(function(){
          vex.closeAll();
        }, 2000);
      })
      .catch(function (error) {
        console.log(error);
      })
    })
  });

  $('body').on('change', ".choose-guideword", function(e) {
      if(e.target.value === 'left') {
        $(".showtable-left").show();
        $(".showtable-right").hide();
      } else {
        $(".showtable-left").hide();
        $(".showtable-right").show();
      }
  });

  $(function() {
    // Get all elements with class step_one
    var $op1 = $('.hide-control-actions');
    var $op2 = $('.hidding-guidewords');

    // Verifies if there is Control Actions stored
    if ($op1 != null) {
        // Show the first control action (with lower id)
        $($op1[0]).show();
    }

    if ($op2 != null) {
        // Show the first control action (with lower id)
        $($op2[0]).show();
    }

  // function to hide all elements with class step_one
  var hideAll = function() {
    $op1.hide();

  };

  // Function to alter the visibility of the control action under analysis
  $('#control-actions-select').change(function(e) {
      // Hide all elements of all control actions
      hideAll();
      // Shows the content of selected control action
      $('#showtable-'+e.target.value).show();
  });

  $('body').on('click', ".gcl2", function(e) {
    var img = $('.gcl');
    if (!img.is(":visible")){
      $(img).show();
      $(".gcl2").html('Hide Generic Control Loop');
    } else {
      $(img).hide();
      $(".gcl2").html('Show Generic Control Loop');
    }
  });

  $('body').on('click', '.accordion', function (event){
    var accordion = $(event.currentTarget);
    accordion.toggleClass('active');
    accordion.next().toggleClass('show');
  });


});

}
