var $ = require('jquery');

var controlactions = [];

function addController(ca) {
	controlactions.push(ca);
}

module.exports = {
	addController : addController,
	init : init,
	showControllers : showControllers
}

function init(){
	var ca = $("#controlactions_content").data("components");
	if (ca != null)
	for (var i = 0; i < ca.length; i++){
		if (ca[i].type === "Controller"){
			controlactions.push(ca[i]);
		}
	}
}

function showControllers(){
	var listControllers = $("#controller-association");
	var retorno = controlactions.map(function(controlaction) {
		return `<option value="${controlaction.id}">${controlaction.name}</option>`;
	});
	listControllers.html(retorno);
}