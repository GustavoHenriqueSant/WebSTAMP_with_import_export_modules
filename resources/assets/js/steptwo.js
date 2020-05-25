var actualPage = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

if(actualPage.includes('steptwo')){
	var $ = require('jquery');

	var ControlActions = require('./elements/controlactions');
	var Drop = require('tether-drop');

	var vex = require('vex-js');
	vex.registerPlugin(require('vex-dialog'));
	vex.defaultOptions.className = 'vex-theme-os';

	var axios = require('./axios');
	
	var steptwo = ['component', 'variable-0'];

	$('.variables-content').each(function(index, f){
		steptwo.push(f.id);
	})
	$('.controlactions-content').each(function(index, f){
		steptwo.push(f.id);
	})
	$('.connections-content').each(function(index, f){
		steptwo.push(f.id);
	})
	$('.item__actions__add').each(function(index, f){
		steptwo.push(f.id);
	})
	
	ControlActions.init();
	steptwo.forEach(function(f) {
		var drop = new Drop({
			target: document.querySelector('[data-add="' + f + '"]'),
			content: document.querySelector('[data-drop="' + f + '"]'),
			openOn: 'click',
			remove: true,
			tetherOptions: {
				attachment: 'top left',
				targetAttachment: 'middle right',
				constraints: [{
					to: 'scrollParent',
					attachment: 'together'
				}]
			}	
		});
	});
	
	var functions = require('./ajax_functions');
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

	//ADD
	$('body').on('submit', '.add-form', function(event) {
		event.preventDefault();
		var form = $(event.currentTarget);
		var activity = form.data("add");
		var activity_name = activity + '-name';
		var name = form.find("#" + activity_name).val();
		var project_id = $('#project_id').val();
		var id = 0;

		// Verify if activity is component
		if (activity === 'component') {
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
	      		}
	      		else if (type === 'ControlledProcess') {
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
	      		} 
	      		else if (type === "Controller") { 
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
	      		} 
	      		else if (type === "Sensor"){
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

		}
		else {
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
							constraints: [{
					  			to: 'scrollParent',
					  			attachment: 'together'
							}]
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
							constraints: [{
						  		to: 'scrollParent',
						  		attachment: 'together'
							}]
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
	//DELETE
	$('body').on('submit', '.delete-form', function(event) {
		event.preventDefault();
		var form = $(event.currentTarget);
		var activity = form.data("delete");
		vex.dialog.confirm({
			message: 'Are you sure you want to delete this item?',
			callback: function (value) {
				if (value) {
					if (activity === 'component') {
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
						} 
						else if (type === 'controlledprocess') {
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
						}
						else if (type === 'controller') {
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
						} 
						else if (type === 'sensor') {
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
					}
					else if (activity === 'controlaction') {
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
					else if (activity === 'variable') {
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
					} 
					else if (activity === 'connection') {
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

	function edit_steptwo(id, activity){
		if (activity == "variable") {
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
		else if(activity == "actuator"){
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
		}
		else if(activity == "controlledprocess"){
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
		}
		else if(activity == "controller"){
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
		}
		else if(activity == "sensor"){
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
		edit_steptwo(id, activity);
	});


	// EDIT WHEN KEY "ENTER" WAS PRESSED
	$("body").on('keypress', '.item__input__active', function(event) {
		if (event.which == 13) {
			event.preventDefault();
			var split = event.currentTarget.id.split("-");
			var id = split[2];
			var activity = split[0];
			edit_stetwo(id, activity);
		}
	});

	$('body').on('click', '.edit-form', function(event) {
		event.preventDefault();
		var form = $(event.currentTarget);
		var activity = form.data("edit");
		if (activity == "variable") {
			var id = form.find("#variable_id").val();
			$('#state-variable-'+id).show();
			$('#variable-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
			return false;
		}
		else if (activity == "actuator"){
			var id = form.find("#actuator_id").val();
			$('#actuator-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
			return false;
		}
		else if (activity == "controlledprocess"){
			var id = form.find("#controlledprocess_id").val();
			$('#controlledprocess-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
			return false;
		} 
		else if (activity == "controller"){
			var id = form.find("#controller_id").val();
			$('#controller-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
			return false;
		}
		else if (activity == "sensor") {
			var id = form.find("#sensor_id").val();
			$('#sensor-description-'+id).attr('class', 'item__input__active').prop('disabled', false);
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

	 $('body').on('click', '.item__delete__box', function(event) {
		var id = $(event.currentTarget).data('index');
		var type = $(event.currentTarget).data('type');
		vex.dialog.confirm({
		message: 'Are you sure you want to delete this item?',
			callback: function (value) {
				if (value) {
					if (type === 'variable'){
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
		if (component_type !== "Controller")
			$("#actuator-type").hide();
		else
			$("#actuator-type").show();
	});
}

