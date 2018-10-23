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
	var index = 0;
	var retorno = accidents.map(function(accident) {
		index++;
		if (project_type == "Safety")
			return `<option value="${accident.id}">[A-${index}] ${accident.name}</option>`;
		else
			return `<option value="${accident.id}">[L-${index}] ${accident.name}</option>`;
	});
	listAccidents.html(retorno);
}