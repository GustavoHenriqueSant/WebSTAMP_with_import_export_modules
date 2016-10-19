var actualPage = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

if (actualPage != 'stepone') {
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
  var fundamentals = ['hazard', 'component', 'systemgoal', 'accident', 'controlaction', 'variable', 'state', 'systemsafetyconstraint'];

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
        //State.showVariables();
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
  var systemsafetyconstraint = require('./templates/systemsafetyconstraint_template');


  // ADD


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
      var accidents_associated = form.find("#hazard-accident-association").val();
      var $newHazard = $('#hazards').find(".substep__list");
      axios.post('/addhazard', {
        name : name,
        id : id,
        accidents_associated : accidents_associated
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
    	var $newComponent = $('#components').find("#add-"  + type.toLowerCase());
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
        //State.addVariable(response.data);
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
    // Verify if activity is variable
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
                $("#variable-" + id).remove();
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


  // MODAL

  $(document).ready(function(){
      $("a[rel=modal]").click( function(ev){
          ev.preventDefault();
   
          var id = $(this).attr("href");
   
          var screen_height = $(document).height();
          var screen_width = $(window).width();
       
          //colocando o fundo preto
          $('#modal-mask').css({'width':screen_width,'height':screen_height});
          $('#modal-mask').fadeIn(1000); 
          $('#modal-mask').fadeTo("slow",0.8);
   
          var left = ($(window).width() /2) - ( $(id).width() / 2 );
          var top = ($(window).height() / 2) - ( $(id).height() / 2 );
       
          $(id).css({'top':top,'left':left});
          $(id).show();   
      });
   
      $("#modal-mask").click( function(){
          $(this).hide();
          $(".modal-window").hide();
      });
   
      $('.modal-close').click(function(ev){
          ev.preventDefault();
          $("#modal-mask").hide();
          $(".modal-window").hide();
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
        $("#accident-description-" + id).replaceWith('<input type="text" class="item__input" id="accident-description-'+id+'" value="'+name+'" size="100">');
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
        $("#variable-description-" + id).replaceWith('<input type="text" class="item__input" id="variable-description-'+id+'" value="'+name+'" size="'+name.length+'">');
      })
      .catch(function (error) {
        console.log(error);
      })
      return false;
    }
}

// EDIT WHEN INPUT LOSES FOCUS
$(".item__input").on('blur', function(event) {
  event.preventDefault();
  var split = event.currentTarget.id.split("-");
  var id = split[2];
  var activity = split[0];
  edit_fundamentals(id, activity);
});

// EDIT WHEN KEY "ENTER" WAS PRESSED
$(".item__input").keypress(function(event) {
  if (event.which == 13) {
    event.preventDefault();
    var split = event.currentTarget.id.split("-");
    var id = split[2];
    var activity = split[0];
    edit_fundamentals(id, activity);
  }
});


  $('body').on('submit', '.edit-form', function(event) {
    event.preventDefault();
    var form = $(event.currentTarget);
    var activity = form.data("edit");
    if (activity == "accident") {
      var id = form.find("#accident_id").val();
      var name = $("#accident-description-"+id).val();
      axios.post('/editaccident', {
          id : id,
          name : name
        })
        .then(function (response) {
          $("#accident-description-" + id).replaceWith('<input type="text" class="item__input" id="accident-description-'+id+'" value="'+name+'" size="100">');
        })
        .catch(function (error) {
          console.log(error);
        })
        return false;
    } else if (activity == "hazard") {
      var id = form.find("#hazard_id").val();
      var name = $("#hazard-description-"+id).val();
      axios.post('/edithazard', {
          id : id,
          name : name
        })
        .then(function (response) {
          $("#hazard-description-" + id).replaceWith('<input type="text" class="item__input" id="hazard-description-'+id+'" value="'+name+'" size="'+name.length+'">');
        })
        .catch(function (error) {
          console.log(error);
        })
        return false;
    } else if (activity == "systemgoal") {
      var id = form.find("#systemgoal_id").val();
      var name = $("#systemgoal-description-"+id).val();
      axios.post('/editsystemgoal', {
          id : id,
          name : name
        })
        .then(function (response) {
          $("#systemgoal-description-" + id).replaceWith('<input type="text" class="item__input" id="systemgoal-description-'+id+'" value="'+name+'" size="100">');
        })
        .catch(function (error) {
          console.log(error);
        })
        return false;
    } else if (activity == "systemsafetyconstraint") {
      var id = form.find("#systemsafetyconstraint_id").val();
      var name = $("#systemsafetyconstraint-description-"+id).val();
      axios.post('/editsystemsafetyconstraint', {
          id : id,
          name : name
        })
        .then(function (response) {
          $("#systemsafetyconstraint-description-" + id).replaceWith('<input type="text" class="item__input" id="systemsafetyconstraint-description-'+id+'" value="'+name+'" size="100">');
        })
        .catch(function (error) {
          console.log(error);
        })
        return false;
    } else if (activity == "variable") {
      var id = form.find("#variable_id").val();
      var name = $("#variable-description-"+id).val();
      axios.post('/editvariable', {
          id : id,
          name : name
        })
        .then(function (response) {
          $("#variable-description-" + id).replaceWith('<input type="text" class="item__input" id="variable-description-'+id+'" value="'+name+'" size="'+name.length+'">');
        })
        .catch(function (error) {
          console.log(error);
        })
        return false;
    }

  });

  $('.item__input').on('keyup', function(event) {
    event.currentTarget.size = event.currentTarget.value.length;
  });

  $(window).load(function(event) {
    $('.item__input').each(function(){
      this.size = this.value.length;
    });
  });

  // DELETE BLUE ITEM -> ACCIDENT(HAZARD) AND VARIABLE(STATE))

  $('.item__delete__box').click(function(event) {
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
  // STEP 1
} else {
  // Require JQuery
  var $ = require('jquery');

  $(function() {
    // Get all elements with class step_one
    var $op1 = $('.testesom');

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
}