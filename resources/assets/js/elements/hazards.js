var $ = require('jquery');

var accidents = [];

function addAccident(ac) {
	accidents.push(ac);
}

module.exports = {
	addAccident : addAccident,
	init : init,
	showAccidents : showAccidents
}

function init(){
	accidents = $("#hazards_content").data("accidents");
}

function showAccidents(){
	var listAccidents = $("#hazard-accident-association");
	var project_type = $("#project_type").val();
	var retorno = accidents.map(function(accident) {
		if (project_type == "Safety")
			return `<option value="${accident.id}">[A-${accident.id}] ${accident.name}</option>`;
		else
			return `<option value="${accident.id}">[L-${accident.id}] ${accident.name}</option>`;
	});
	listAccidents.html(retorno);
}