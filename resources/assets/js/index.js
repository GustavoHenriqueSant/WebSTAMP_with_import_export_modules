var actualPage = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

require('./textarea_script');

require('./steptwo');

if (actualPage.includes('stepone') || actualPage.includes('projects')) {
  var $ = require('jquery');

  var Hazard = require('./elements/hazards');
  //var State = require('./elements/states');
  var ControlActions = require('./elements/controlactions');
  var SystemSafetyConstraint = require('./elements/system_safety_constraints');
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
  SystemSafetyConstraint.init();
  //State.init();
  ControlActions.init();
  var stepone = ['hazard', 'systemgoal', 'assumption', 'loss', 'systemsafetyconstraint'];
  stepone.forEach(function(f) {
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
        Hazard.showLosses();
      }
      else if(f === "systemsafetyconstraint"){
        SystemSafetyConstraint.showHazards();
      }
    })
  });

  var functions = require('./ajax_functions');

  var systemgoal = require('./templates/systemgoal_template');
  var assumption = require('./templates/assumption_template');
  var loss = require('./templates/loss_template');
  var hazard = require('./templates/hazard_template');
  var systemsafetyconstraint = require('./templates/systemsafetyconstraint_template');

  // I create that variable to collect the old text (before the editing) of an activity in the "purpose of the analysis"
  // I need to create it to refresh the "Associated Losses" and "Associated System-level hazards" after an editing.
  var oldText = "";

  // da para apagar depois
  
  // function getLossesId(myString) {
  //   var myRegexp = /\[L\-\d+\]/g;
  //   var match = myRegexp.exec(myString);
  //   var str_return = "";
  //   var matches = [];
  //   while (match != null) {
  //     str_return += match[0];
  //     match = myRegexp.exec(myString);
  //     str_return += (match != null) ? "," : "";
  //   }
  //   myRegexp = /\d+/g;
  //   match = myRegexp.exec(str_return);
  //   str_return = "";
  //   while (match != null) {
  //     str_return += match[0];
  //     match = myRegexp.exec(myString);
  //     str_return += (match != null) ? "," : "";
  //   }
  //   return str_return;
  // }

  // ADD

  $('body').on('submit keydown', '.add-form', function(event) {
    if(event.type == "submit" || (event.type == "keydown" && event.keyCode == 13 && !event.shiftKey))
    {
      event.preventDefault();
      var form = $(event.currentTarget);
      var activity = form.data("add");
      var activity_name = activity + '-name';
      var name = form.find("#" + activity_name).val();
      if(name.length == 0){
        vex.dialog.alert("This field is required");
        return;
      }
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
          $("textarea").each(function(textarea) {
            $(this).height($(this)[0].scrollHeight);
          });
        })
        .catch(function (error) {
          console.log(error);
        });
      }
      // Verifies if activity is assumption
      else if(activity == 'assumption'){
        var $newAssumption = $('#assumptions').find(".substep__list");
        axios.post('/addassumption', {
          name: name,
          id : id,
          project_id : project_id
        })
        .then(function(response){
          var exihibition_id = $newAssumption.children().length + 1;
          console.log($('#assumptions').find("substep__list").children());
          $newAssumption.append(assumption(response.data, exihibition_id));
          $("textarea").each(function(textarea) {
            $(this).height($(this)[0].scrollHeight);
          });
        })
        .catch(function (error) {
          console.log(error);
        });
      }
      // Verifies if activity is loss
      else if (activity === 'loss') {
        var $newLoss = $('#losses').find(".substep__list");
        axios.post('/addloss', {
          name: name,
          id : id,
          project_id : project_id
        })
        .then(function (response) { 
          Hazard.addLoss(response.data);
          var exihibition_id = $('#losses').find(".substep__list").children().length + 1;
          $newLoss.append(loss(response.data, exihibition_id));
          $("textarea").each(function(textarea) {
            $(this).height($(this)[0].scrollHeight);
          });
        })
        .catch(function (error) {
          console.log(error);
        });
      // Verify if activity is hazard
      } else if (activity === 'hazard') { 
        var losses_associated = form.find("#hazard-loss-association").val();
        if(losses_associated == null){
          vex.dialog.alert("Select at least one Loss to associate");
          return;
        }
        var $newHazard = $('#hazards').find(".substep__list");
        var project_type = $('#project_type').val();

        var losses_map = [];
        var aux = form.find("#hazard-loss-association :selected");
        for(var i = 0; i < aux.length; i++){
          losses_map[aux[i].value] = aux[i].attributes[1].nodeValue;
        }

        axios.post('/addhazard', {
          name : name,
          id : id,
          losses_associated : losses_associated,
          project_id : project_id,
          project_type : project_type
        })
        .then(function(response) {
          SystemSafetyConstraint.addHazard(response.data);
          var exihibition_id = $("#hazards_content").children().children().length + 1;
          $newHazard.append(hazard(response.data, exihibition_id, losses_associated, losses_map));
          $("textarea").each(function(textarea) {
            $(this).height($(this)[0].scrollHeight);
          });
        })
        .catch(function(error) {
          console.log(error);
        })
      }
      // Verify if activity is System Safety Constraint
      else if (activity === 'systemsafetyconstraint') {
        var hazards_associated = form.find("#ssc-hazard-association").val();
        var $newSSC = $('#systemsafetyconstraint').find(".substep__list");
        if(hazards_associated == null){
          vex.dialog.alert("Select at least one System-level Hazard to associate");
          return;
        }
        var hazards_map = [];
        var aux = form.find("#ssc-hazard-association :selected");
        for(var i = 0; i < aux.length; i++){
          hazards_map[aux[i].value] = aux[i].attributes[1].nodeValue;
        }

        axios.post('/addsystemsafetyconstraint', {
          name : name,
          id : id,
          project_id : project_id,
          hazards_ids : hazards_associated
        })
        .then(function(response) {
          var exihibition_id = $('#systemsafetyconstraint').find(".substep__list").children().length + 1;  
          $newSSC.append(systemsafetyconstraint(response.data, exihibition_id, hazards_associated, hazards_map));
          $("textarea").each(function(textarea) {
            $(this).height($(this)[0].scrollHeight);
          });
        })
        .catch(function(error) {
          console.log(error);
        })
      }
      
      return false;

    }
    
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
          if (activity === 'loss'){
            var id = form.find("#loss_id").val();
            axios.post('/deleteloss', {
                id : id,
              })
              .then(function (response) {
                Hazard.removeLoss(id);
                $("a[id^='hazard_loss_'][id$='" + id +"'").remove();
                $("#loss-" + id).remove();
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
          } else if (activity === 'assumption'){
            var id = form.find("#assumption_id").val();
            axios.post('/deleteassumption', {
                id : id,
              })
              .then(function (response) {
                $("#assumption-" + id).remove();
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
                SystemSafetyConstraint.removeHazard(id);
                $("a[id^='ssc_hazard_'][id$='" + id +"'").remove();
                $("#hazard-" + id).remove();
              })
              .catch(function (error) {
                console.log(error);
              })
              return false;
          } else if (activity === 'systemsafetyconstraint') {
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

function edit_stepone(id, activity, text) {
  var result = true;
  if (activity == "loss") {
    axios.post('/editloss', {
        id : id,
        name : text
      })
      .then(function (response) {
        Hazard.editLoss(oldText, text);
        result = true;
      })
      .catch(function (error) {
        console.log(error);
      })
  } else if (activity == "hazard") {
    var losses_ids = $('#hazard_loss-' + id).val();
    if(losses_ids == null){
      vex.dialog.alert('At least one loss must be selected');
    }else{
      var losses_map = [];
      $('#hazard_loss-' + id + ' option:selected').each(function(index,value){
        losses_map[value.value] = $(value).attr('name');
      })
      axios.post('/edithazard', {
          id : id,
          name : text,
          losses_ids : losses_ids
        })
        .then(function (response) {
          SystemSafetyConstraint.editHazard(oldText, text);
          result = true;
          var list_of_losses = "";
          $("#hazard_" + id +"_losses_associated").val(losses_ids);
          losses_ids.forEach(function(f, index){
            list_of_losses += `<a class="hazard_loss_association" id="hazard_loss_${id}_${f}">${losses_map[f]}</a>&nbsp&nbsp`;
          });
          $('#hazard_'+ id +'_losses').html(list_of_losses);
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  } else if (activity == "systemgoal") {
    axios.post('/editsystemgoal', {
        id : id,
        name : text
      })
      .then(function (response) {
        result = true;
      })
      .catch(function (error) {
        console.log(error);
      })
  } else if (activity == "assumption") { 
    axios.post('/editassumption', {
        id : id,
        name : text
      })
      .then(function (response) {
        result = true;
      })
      .catch(function (error) {
        console.log(error);
      })   
  } else if (activity == "systemsafetyconstraint") {
    var hazards_ids = $('#ssc_hazard-' + id).val();
    if(hazards_ids == null){
      vex.dialog.alert('At least one hazard must be selected');
    }else{
      var hazards_map = [];
      $('#ssc_hazard-' + id + ' option:selected').each(function(index,value){
        hazards_map[value.value] = $(value).attr('name');
      })
      axios.post('/editsystemsafetyconstraint', {
          id : id,
          name : text,
          hazards_ids : hazards_ids
        })
        .then(function (response) {
          result = true;
          var list_of_hazards = "";
          $("#ssc_" + id +"_hazards_associated").val(hazards_ids);
          hazards_ids.forEach(function(f, index){
            list_of_hazards += `<a class="ssc_hazard_association" id="ssc_hazard_${id}_${f}">${hazards_map[f]}</a>&nbsp&nbsp`;
          });
          $('#ssc_'+ id +'_hazards').html(list_of_hazards);
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  }

  return result;
}


// EDIT WHEN KEY "ENTER" WAS PRESSED OR CANCEL WHEN KEY "ESC" WAS PRESSED
$("body").on('keydown', '.responsive_textarea_active', function(event) {
  if(event.keyCode == 27){
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[2];
    var activity = split[0];
    cancel_edit(id, activity);
  }
  if(event.keyCode == 13 && !event.shiftKey){
    //event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[2];
    var activity = split[0];
    var text = $("#" + activity + "-description-" + id).val();
    var result = edit_stepone(id, activity, text);
    if(result){
      $('#default-menu-' + activity + '-' + id).show();
      $('#edition-menu-' + activity + '-' + id).hide();
      $('#'+ activity +'-description-' + id).attr('class', 'responsive_textarea').prop('disabled', true);
    }
  }
});

  function cancel_edit(id, activity){
    $('#default-menu-' + activity + '-' + id).show();
    $('#edition-menu-' + activity + '-' + id).hide();
    axios.post("/text" + activity, {
      id: id
    })
    .then(function (response) {
      $('#'+ activity +'-description-' + id).val(response.data.name);
    })
    .catch(function (error) {
      console.log(error);
    });
    $('#'+ activity +'-description-' + id).attr('class', 'responsive_textarea').prop('disabled', true);
  }

  $(document).ready(function(){
    $("textarea").each(function(textarea) {
      $(this).height($(this)[0].scrollHeight);
    });
  });

  $('body').on('click', '.edit-btn', function(event) {
    var id = $(this).attr('name');
    var activity = $(this).attr('alt').split('-')[1];
    $('#default-menu-' + activity + '-' + id).hide();
    $('#edition-menu-' + activity + '-' + id).show();
    $('#'+ activity +'-description-' + id).attr('class', 'responsive_textarea_active').prop('disabled', false);
    oldText = $('#' + activity + '-description-'+id).val();
    if(activity == "systemsafetyconstraint"){
      $('#ssc_hazard_association-' + id).show();
      $('#ssc_' + id + '_hazards').hide();
      var ids = $("#ssc_" + id +"_hazards_associated").val();
      SystemSafetyConstraint.showAssociatedHazards(ids ,id);
    }else if(activity == "hazard"){
      $('#hazard_loss_association-' + id).show();
      $('#hazard_' + id + '_losses').hide();
      var ids = $("#hazard_" + id +"_losses_associated").val();
      Hazard.showAssociatedLosses(ids ,id);
    }
  });

  $('body').on('click', '.cancel-edit-btn', function(event) {
    var id = $(this).attr('name');
    var activity = $(this).attr('alt').split('-')[1];
    cancel_edit(id, activity);
    if(activity == "systemsafetyconstraint"){
      $('#ssc_hazard_association-' + id).hide();
      $('#ssc_' + id + '_hazards').show();
    }else if(activity == "hazard"){
      $('#hazard_loss_association-' + id).hide();
      $('#hazard_' + id + '_losses').show();
    }
  });

  $('body').on('click', '.edit-form', function(event){
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("edit");
    var id = form.find("#" + activity + "_id").val();
    var text = $("#" + activity + "-description-" + id).val();
    var result = edit_stepone(id, activity, text);
    if(result){
      $('#default-menu-' + activity + '-' + id).show();
      $('#edition-menu-' + activity + '-' + id).hide();
      $('#'+ activity +'-description-' + id).attr('class', 'responsive_textarea').prop('disabled', true);
      if(activity == "systemsafetyconstraint"){
        $('#ssc_hazard_association-' + id).hide();
        $('#ssc_' + id + '_hazards').show();
      }else if(activity == "hazard"){
        $('#hazard_loss_association-' + id).hide();
        $('#hazard_' + id + '_losses').show();
      }
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

  // DELETE BLUE ITEM -> LOSS(HAZARD) AND VARIABLE(STATE))

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
  // STEP 3
} else if(actualPage.includes('stepthree')) {
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

  //vai apagar depois

  // $("body").on('blur', '.uca_list_textarea', function(event) {
  //   event.preventDefault();
  //   var split = event.currentTarget.id.split("-");
  //   var id = split[1];
  //   var activity = split[0];
  //   $("#type-"+id).attr('class', 'type-combo');
  //   edit_uca_sc(id);
  // });

  // $("body").on('change', '.item__input__active', function(event) {
  //   event.preventDefault();
  //   var split = event.currentTarget.id.split("-");
  //   var id = split[1];
  //   var activity = split[0];
  //   $("#type-"+id).attr('class', 'type-combo');
  //   edit_uca_sc(id);
  // });



  // // // EDIT WHEN KEY "ENTER" WAS PRESSED
  // // $("body").on('keypress', '.uca_list_textarea', function(event) {
  // //   if (event.which == 13) {
  // //     event.preventDefault();
  // //     var split = event.currentTarget.id.split("-");
  // //     var id = split[2];
  // //     var activity = split[0];
  // //     edit_uca_sc(id, activity);
  // //   }
  // // });

  $("body").on('change', '.type-combo', function(event) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[1];
    var activity = split[0];
    edit_causal_analysis(id);
  });

  //apaga depois


  // function edit_uca_sc(id) {
  //   var unsafe_control_action = $("#unsafe_control_action-" + id).val();
  //   var type = $("#type-" + id + " option:selected").val();
  //   var safety_constraint = $("#safety_constraint-" + id).val();
  //   axios.post('/edituca', {
  //     id : id,
  //     unsafe_control_action : unsafe_control_action,
  //     type : type,
  //     safety_constraint : safety_constraint
  //   })
  //   .then(function(response) {
  //     $("#unsafe_control_action-"+id).prop('disabled', true);
  //     $("#type-"+id).prop('disabled', true);
  //     $("#safety_constraint-"+id).prop('disabled', true);
  //   })
  //   .catch(function(error) {
  //     console.log(error);
  //   })
  // }


  // $('.add-uca').each(function(index, f){
  //   uca.push(f.id);
  // })
  // uca.forEach(function(f) {
  //   var drop = new Drop({
  //     target: document.querySelector('[data-add="' + f + '"]'),
  //     content: document.querySelector('[data-drop="' + f + '"]'),
  //     openOn: 'click',
  //     remove: true,
  //     tetherOptions: {
  //       attachment: 'top left',
  //       targetAttachment: 'middle right',
  //       constraints: [
  //         {
  //           to: 'scrollParent',
  //           attachment: 'together'
  //         }
  //       ]
  //     }
  //   });
  // });

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


  // $('body').on('click', '.add-new-uca', function(event){
  //   event.preventDefault();
  //   $(".unsafe-control").each(function(){
  //     $(this).html("");
  //   });
  //   $(".safety-control").each(function(){
  //     $(this).html("");
  //   });
  //   var form = $(event.currentTarget);
  //   var controlaction_id = form.attr("id").split("-")[1];
  //   vex.closeAll();
  //   vex.open({
  //     unsafeContent: $("#add-new-uca-" + controlaction_id).html(),
  //     buttons: [
  //       $.extend({}, vex.dialog.buttons.YES, { text: 'Include' }),
  //       $.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
  //     ],
  //     showCloseButton: true,
  //     className: "vex-theme-default"
  //   });
  // });

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

  $('body').on('click', '.context_table_filter-button', function(event){
    event.preventDefault();
    vex.closeAll();
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();
    var i, checkboxes = document.querySelectorAll('input[value*=-ca-' + selected_controlAction + ']');

    vex.open({
      unsafeContent: $("#filter-ca-"+selected_controlAction).html(),
      showCloseButton: true,
      afterOpen: function(){
        for (i = 0; i < checkboxes.length; i++) {
          if(localStorage.getItem(checkboxes[i].value) != null){
            $('input[value=' + checkboxes[i].value +']').prop('checked', localStorage.getItem(checkboxes[i].value) === 'true' ? true:false);
          }
          else{
            checkboxes[i].checked = true;
          } 
        }
      },
    });
    

  });
  
  $('body').on('click', 'input[name=check_columnProvided]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnProvided-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnProvided-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });
  
  $('body').on('click', 'input[name=check_columnNotProvided]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnNotProvided-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnNotProvided-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $('body').on('click', 'input[name=check_columnWrongOrder]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnWrongOrder-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnWrongOrder-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $('body').on('click', 'input[name=check_columnTooEarly]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnTooEarly-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnTooEarly-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $('body').on('click', 'input[name=check_columnTooLate]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnTooLate-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnTooLate-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $('body').on('click', 'input[name=check_columnTooSoon]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnTooSoon-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnTooSoon-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $('body').on('click', 'input[name=check_columnTooLong]', function(event){
    var selected_controller = $('#controller-select').val();
    var selected_controlAction = $('select[name="control-actions-of-controller-' + selected_controller).val();

    localStorage.setItem(this.value, this.checked);

    $('td[name=columnTooLong-ca-'+ selected_controlAction + ']').toggle(this.checked);
    $('#columnTooLong-ca-'+ selected_controlAction +'-header').toggle(this.checked);
  });

  $(document).ready(function () {
    require('./jquery.floating.min.js');
    $(".context_table_style").floatingScroll();
});


  $(window).load(function(event){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var ca = url.searchParams.get("ca");
    var controller = url.searchParams.get("controller");

    if(ca != null && controller != null)
    {
      $('#controller-select').val("" + controller);
      
      $('#controller-select').change();

      $('select[name="control-actions-of-controller-' + controller).val("" + ca);

      // Hide all elements of all control actions
      $('.hide-control-actions').hide();
      // Shows the content of ca in params
      $('#control-action-'+ca).show();
    }


    for (var key in localStorage) {
      $('td[name='+ key +']').toggle(localStorage.getItem(key) === 'true' ? true:false);
      $('#' + key + '-header').toggle(localStorage.getItem(key) === 'true' ? true:false);
    }
    
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

  //Perguntar depois
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
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
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

  $('body').on('change', '.add-uca-change', function(event) {
    var form = $(event.currentTarget).closest(".adding-manual-uca");
    var controlaction_id = form.find("#controlaction_id").val();
    var controller_name = form.find("#controller_name").val();
    var controlaction_name = form.find("#controlaction_name").val();
    var type = "";
    $(".type-uca").each(function(index, f){
      if (index >= 0 && f.id.split("-")[2] == controlaction_id){
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
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
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
      $(".unsafe-control").html("<br/><center><b>Potentially hazardous control action:</b></center><br/><span class='unsafe-control-name'>" + unsafe_control_action + "</span>.");
      $(".safety-control").html("<br/><center><b>Associated safety & security constraint:</b></center><br/><span class='safety-control-name'>" + safety_constraint + "</span>.");
    }
    console.log(controlaction_id);
    $(".adding-manual-uca").find("#context").val(states.join(",")); //.val();
  });

  // Add UCA and Safety Constraint Associated
  $('body').on('submit', '.adding-manual-uca', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var controlaction_id = form.find("#controlaction_id").val();
    var unsafe_control_action = form.find(".unsafe-control-name").html();
    var safety_constraint = form.find(".safety-control-name").html();
    var type = form.find("#type-uca-" + controlaction_id + " option:selected").val();
    var context = form.find("#context").val();
    var hazard_column = form.find("#hazard_column");
    var hazards_ids = hazard_column.val();
    var hazards_infos = [];
    var token = form.find("input[name='_token']").val();
    hazard_column.find('option:selected').each(function(index, hazard){
      hazards_infos.push(hazard.getAttribute('name'));
    });
    // Rule_is is always zero when the analyst add it.
    var rule_id = 0;
    var id = 0;
    function checkStates(state){
      return state.value === "";
    }

    var states = form.find(".uca-row-"+controlaction_id+" option:selected").toArray();
    if(states.every(checkStates)){
      vex.dialog.alert("Select at least one variable state option to edit the unsafe control action");
    }
    else{
      axios.post('/adduca', {
        id : id,
        unsafe_control_action : unsafe_control_action,
        safety_constraint : safety_constraint,
        type : type,
        controlaction_id : controlaction_id,
        context : context,
        rule_id : rule_id,
        hazards_ids: hazards_ids
      })
      .then(function (response) {
        $("#uca-" + controlaction_id).find(".container-fluid").append(UCA(response.data, hazards_infos, token));
      })
      .catch(function (error) {
        console.log(error);
      })
    }
    
  });

  $('.option_text').mousedown(function(e) {
    e.preventDefault();
    var originalScrollTop = $(this).parent().scrollTop();
    $(this).prop('selected', $(this).prop('selected') ? false : true);
    var self = this;
    $(this).parent().focus();
    setTimeout(function() {
        $(self).parent().scrollTop(originalScrollTop);
    }, 0);
    
    return false;
  });

  $('body').on('change', '.edit-uca-change', function(event) {
    var form = $(event.currentTarget).closest(".edit-manual-uca");
    var controlaction_id = form.find("#controlaction_id").val();
    var controller_name = form.find("#controller_name").val();
    var controlaction_name = form.find("#controlaction_name").val();
    var type = "";
    $(".edit_type-uca").each(function(index, f){
      if (index >= 0 && f.id.split("-")[2] == controlaction_id){
        type = $(f).find("option:selected").val();
      }
    });
    var states = [];
    var states_name = [];
    var contador = 0;
    var variables = form.find(".uca-edit-row-" +  controlaction_id + " option:selected");
    var i = 0;
    $('input#sc_flag').val(0);
    for(i = 0; i < variables.length; i++){
      if (variables[i].value.split("-")[0] > 0){
        if($.inArray(variables[i].value.split("-")[0], states) == -1){
          states.push(variables[i].value.split("-")[0]);
          states_name.push(variables[i].value.split("-")[1] + " is " + variables[i].text);
        }
      }
    }
    
    var unsafe_control_action = "";
    var safety_constraint = "";
    if (type.includes("too late") || type.includes("too soon") || type.includes("too early") || type.includes("too long")){
      unsafe_control_action = controller_name.toLowerCase() + " provided " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
      safety_constraint = controller_name.toLowerCase() + " must not provide " + controlaction_name.toLowerCase() + " " + type.toLowerCase().substring(8) + " when";
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
    // if(states_name.length > 0){

    $(".edit-safety-text").val(safety_constraint);
    $(".edit-unsafe-text").val(unsafe_control_action);

    $(".uca-edition-text").html("Updated unsafe control action:");
    
    $(".edit-manual-uca").find("#context").val(states.join(",")); //.val();
  });

  $('body').on('keypress', '.uca_list_textarea', function(event){
    if($('#sc_flag').val() == 0){
      vex.dialog.confirm({
        unsafeMessage: 'If you check this warning message with "OK" and manually update the text of unsafe control action and save it, it will imply in: <br>' 
                    + "1. You will not be able to use the Template Instantiation on the Identify Loss Scenarios step; <br>"
                    + "2. If you change the context of the unsafe control action using the select boxes, the edition made manually in the text will be lost;<br>" 
                    + "3. To use the Template Instantiation again, update the unsafe control action selecting its context using the select boxes. Make sure that you will not edit the text manually. <br>"
                    + 'Click "Ok" to continue editing, or "Cancel" to abort.',
        callback: function(value){
          if(value){
            $('input#sc_flag').val(1);
          }
        }
      });
    }
    
  });

  $('body').on('submit', '.edit-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("edit");
    var controlaction_id = form.find("#controlaction_id").val();
    var safety_constraint_id = form.find("#safety_constraint_id").val();
    var safety_constraint_type = form.find("#safety_constraint_type").val();
    if (activity === "uca") {

      axios.post('/scdata', {sc_id: safety_constraint_id})
      .then(function(response){
        vex.closeAll();
        vex.open({
          unsafeContent: $(".edit-uca-" + controlaction_id).html(),
          showCloseButton: true,
          className: "vex-theme-default",
          afterOpen: function(callback){

            $('.option_text').mousedown(function(e) {
              e.preventDefault();
              var originalScrollTop = $(this).parent().scrollTop();
              $(this).prop('selected', $(this).prop('selected') ? false : true);
              var self = this;
              $(this).parent().focus();
              setTimeout(function() {
                  $(self).parent().scrollTop(originalScrollTop);
              }, 0);
              
              return false;
            });
            
            var context = response.data.context.split(',');

            //set the context of safety constraint
            $("select.edit_type-uca option:selected").each(function(){
              $(this).prop("selected", false);
            });

            $("select.edit_type-uca option[value='" + response.data.type + "']").prop('selected', true);
            

            //clear all variables selects before set the safety constraint states of context
            $('.uca-edit-row-' + controlaction_id + ' option:selected').each(function(){
              $(this).prop("selected", false);
            });

            //set variables states of safety constraints
            context.forEach(function(element){
              $('.uca-edit-row-' + controlaction_id + ' option[value^="' + element +'"').prop("selected", true);
            });

            $("input#id_sc_ca_" + controlaction_id).val(safety_constraint_id);
            $("input#sc_flag").val(response.data.flag);
            $(".edit-unsafe-text").html(""+response.data.uca);
            $(".edit-safety-text").html(""+response.data.sc);

            //clear all hazards selecteds in associated hazards select field
            $('.hazard_column_edit_uca option:selected').each(function(){
               $(this).prop("selected", false);
            });

            //set associated hazards of safety constraint
            var hazards = response.data.hazards;
            hazards.forEach(function(element){
              $('.hazard_column_edit_uca option[value="' + element.hazard_id + '"]').prop("selected", true);
            });
          }
        });
        
      })
      .catch(function(error){
        console.log(error);
      })
    }
  });

  $('body').on('submit', '.edit-manual-uca', function(event){
    event.preventDefault();
    var form = $(event.currentTarget);
    var controlaction_id = form.find("#controlaction_id").val();

    function checkStates(state){
      return state.value === "";
    }

    var states = form.find(".uca-edit-row-"+controlaction_id+" option:selected").toArray();
    if(states.every(checkStates)){
      vex.dialog.alert("Select at least one variable state option to edit the unsafe control action");
    }
    else{
      vex.dialog.confirm({
        message: "Update the unsafe control action implies on refresh the page. All unsaved data will be lost. Are you sure?",
        callback: function(confirmation){
          if(confirmation){
            
            var safety_constraint_id = form.find("#id_sc_ca_"+controlaction_id).val();
            var safety_constraint_type = form.find("#edit_type-uca-"+controlaction_id).val();
            var unsafe_text = form.find(".edit-unsafe-text").val();
            var constraint_text = form.find(".edit-safety-text").val();
            var hazards_ids = form.find(".hazard_column_edit_uca").val();
            var context = form.find("#context").val();
            var flag = form.find("#sc_flag").val();

            axios.post('/edituca', {
              id: safety_constraint_id,
              unsafe_control_action: unsafe_text,
          
              safety_constraint: constraint_text,
              type: safety_constraint_type,
              context: context,
              flag: flag,
              hazards_ids: hazards_ids
            })
            .then(function(response){
              setTimeout(function(){
                var ca = window.location.search.substr(1).split("=");
                if (ca.length > 1){
                  var currentURL = window.location.href.split("?");
                  window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                }
                else{
                  window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                } 
              }, 2000);
            })
            .catch(function(error){
              console.log(error);
            })            
          }
        }
      }); 
    }
  });

  // UPDATE 15/02/21
  $('#load-button').on('click', function(event) {
    let controller = $("#controller-select").val();
    let ca = $(`select[name="control-actions-of-controller-${controller}"]`).val();
    vex.dialog.confirm({
      message: 'The page will reload and all unsaved changes will be lost. Proceed?',
      callback: function (value) {
        if (value) {
          window.location.replace(location.protocol + '//' + location.host + location.pathname + "?ca=" + ca + "&controller=" + controller);
        }
      }
    });
  });

  

  //select controller event on step 3
  $("#controller-select").change(function(e){
    var controllerSelected_id = $(this).children("option:selected").val();

    $(".hide-control-actions-options").hide();

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').val(0);

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').show();

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').change(function(e) {
        $("#load-step3-content").show();
        // Hide all elements of all control actions
        $('.hide-control-actions').hide();
        // Shows the content of selected control action
        $('#control-action-'+e.target.value).show();
        var ca_id = window.location.search.substr(1).split("=");
        //alert(e.target.value);
      });

    $("#div_select_control_action").show();

    $('.hide-control-actions').hide();

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
            if (ca.length > 1){
              var currentURL = window.location.href.split("?");
              window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
            }
            else{
              window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
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
            if (ca.length > 1){
              var currentURL = window.location.href.split("?");
              window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
            }
            else{
              window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
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
          
          var column = "";
          var columns = form.find("#rule_column").val();
          var hazards = form.find("#hazard_column").val();

          //console.log(hazards);
          for (var i=0; i < columns.length; i++) {
            column += (i < columns.length-1) ? columns[i] + ";" : columns[i];
          }
          var variables_array = [];
          var states_final = [];
          var rules_variables = [];
          // Save each variable of the rule
          var variables = form.find('[id^="variable_id_"]').each(function() {
            var ids = form.find(this).val().split("-");
            var variable_id = ids[0];
            var state_id = ids[1];
            if (state_id > 0)
              variables_array.push(state_id);
            var name = $(this).find('option:selected').attr('name');
            if (name !== "ANY")
              states_final.push(getVariableName(state_id) + " is " + getStateName(state_id));
            
            rules_variables.push({variable_id: variable_id, state_id: state_id});
          });
          
          axios.post('/addrule', {
            rules_variables : rules_variables,
            controlaction_id : controlaction_id,
            column : column
          })
          .then(function (response){
            var rule_id = response.data.rule_id;

            var column_index = -1;
            columns.forEach(function(column_name) {
              var sc = generateUCAText(controlaction_id, controller_name, controlaction_name, column_name, states_final);
              var context = "";
              variables_array.forEach(function(f, index) {
                //console.log(f);
                if (index == 0)
                  context += f;
                else if (index < variables_array.length)
                  context += "," + f;
              });
              column_index++;
              axios.post('/adduca', {
                unsafe_control_action : sc.unsafe_control_action,
                safety_constraint : sc.safety_constraint,
                type : columns[column_index],
                controlaction_id : controlaction_id,
                hazards_ids: hazards,
                rule_id : rule_id,
                context : context
              })
              .then(function(response){
                setTimeout(function(){
                  var ca = window.location.search.substr(1).split("=");
                  if (ca.length > 1){
                    var currentURL = window.location.href.split("?");
                    window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                  }
                  else{
                    window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                  } 
                }, 2000);
              })
              .catch(function (error) {
                console.log(error);
              })
            });
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    }  
  });
});

$("img[id^='cancel-edit-rule']").hover(function(){
  $(this).css('cursor','pointer');
})

$("img[id^='cancel-edit-rule']").on('click', function(event) {

    var ids = $(this).attr("name").split("-");

    $("#rule-" + ids[0] + "-" + ids[1] + "-edition").hide();
    $("#rule-" + ids[0] + "-" + ids[1] + "-view").show();
});
  
  //EDIT RULES
$('body').on('submit', '.edit-rule-form', function(event){

  event.preventDefault();
  var form = $(event.currentTarget);
  var activity = form.data("edit");
  
  if(activity == 'rules'){
    var rule_id = form.find("#rule_id").val();
    var controlaction_id = form.find('#controlaction_id').val();
    if($("#rule-" + rule_id + "-" + controlaction_id + "-edition").is(":hidden")){
      $("#rule-" + rule_id + "-" + controlaction_id + "-edition").show();
      $("#rule-" + rule_id + "-" + controlaction_id + "-view").hide();
    }
    else{
      //edit rule
      vex.dialog.confirm({
        message: 'Editing a rule implies on refresh the page. All unsaved data will be lost.  Are you sure?',
        callback: function(value){
          if(value){
            var controlaction_id = form.find("#controlaction_id").val();
            var controlaction_name = $("#controlaction_name_"+controlaction_id).val();
            var controller_name = $("#controller_name_"+controlaction_id).val();
            var rule_id = form.find("#rule_id").val();
            var column = "";
            var columns = form.find("#rule_column_edition").val();
            var hazards = form.find('#hazard_column_edition').val();

            for (var i=0; i < columns.length; i++) {
              column += (i < columns.length-1) ? columns[i] + ";" : columns[i];
            }
            var variables_array = [];
            var states_final = [];
            var rules_variables = [];

            var variables = form.find('[id^="variable_id_"]').each(function() {
              var ids = $(this).val().split("-");
              var variable_id = ids[0];
              var state_id = ids[1];
              if (state_id > 0)
                variables_array.push(state_id);
              var name = $(this).find('option:selected').attr('name');
              if (name !== "ANY")
                states_final.push(getVariableName(state_id) + " is " + getStateName(state_id));
              
              rules_variables.push({variable_id: variable_id, state_id: state_id});
            });
            
            axios.post('/editrule', {
                rule_id: rule_id,
                rules_variables: rules_variables,
                column : column
            })
            .then(function (response){
              var column_index = -1;
              columns.forEach(function(column_name) {
                var sc = generateUCAText(controlaction_id, controller_name, controlaction_name, column_name, states_final);
                var context = "";
                variables_array.forEach(function(f, index) {
                  //console.log(f);
                  if (index == 0)
                    context += f;
                  else if (index < variables_array.length)
                    context += "," + f;
                });
                column_index++;
                axios.post('/editucaByRule', {
                  unsafe_control_action : sc.unsafe_control_action,
                  safety_constraint : sc.safety_constraint,
                  type : columns[column_index],
                  controlaction_id: controlaction_id, 
                  hazards_ids : hazards,
                  rule_id : rule_id,
                  context : context
                })
                .catch(function (error) {
                  console.log(error);
                });
              })

              axios.post('/refreshUcasByRule', {
                rule_id : rule_id
              })
              .then(function(response){
                setTimeout(function(){
                  var ca = window.location.search.substr(1).split("=");
                  if (ca.length > 1){
                    var currentURL = window.location.href.split("?");
                    window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                  }
                  else{
                    window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                  } 
                }, 2000);
              })
              .catch(function (error) {
                console.log(error);
              });
            }).catch(function (error) {
                console.log(error);
            });

            
          }
        }
      });
    }
  }
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
            var rule_id = form.find("#rule_id").val();
             var controlaction_id = form.find("#controlaction_id").val();
              axios.post('/deleterule', {
                rule_id : rule_id,
              })
              .then(function (response) {
                var ca = window.location.search.substr(1).split("=");
                if (ca.length > 1){
                  var currentURL = window.location.href.split("?");
                  window.location.href = currentURL[0] + '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                }
                else{
                  window.location.href += '?ca=' + controlaction_id + '&controller=' + $('#controller-select').val();
                } 
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

} 
//STEP 4
else if(actualPage.includes('stepfour')) {
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
//select controller event on step 3
  $("#controller-select").change(function(e){
    var controllerSelected_id = $(this).children("option:selected").val();

    $(".hide-control-actions-options").hide();

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').val(0);

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').show();

    $('select[name=control-actions-of-controller-' + controllerSelected_id+']').change(function(e) {
        // Hide all elements of all control actions
        $('.hide-control-actions').hide();

        // Shows the content of selected control action
        $('#showtable-'+e.target.value).show();
        //alert(e.target.value);
      });

    $("#div_select_control_action").show();

    $('.hide-control-actions').hide();

  });
  
  $(function() {
    // Get all elements with class step_one
    var $op2 = $('.hidding-guidewords');

    if ($op2 != null) {
        // Show the first control action (with lower id)
        $($op2[0]).show();
    }

  // function to hide all elements with class step_one
  // Function to alter the visibility of the control action under analysis

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
