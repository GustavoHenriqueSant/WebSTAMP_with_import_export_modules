var $ = require('jquery');

var hazards = [];

function addHazard(hazard) {
	hazards.push(hazard);
}

module.exports = {
	addHazard : addHazard,
	init : init,
	showHazards : showHazards
}

function init(){
	hazards = $("#ssc_content").data("hazards");
}

function showHazards(){
	var listHazards = $("#ssc-hazard-association");
	var project_type = $("#project_type").val();
	var index = 0;
	var retorno = hazards.map(function(hazard) {
		index++;
		return `<option value="${hazard.id}" name="[H-${index}]">[H-${index}] ${hazard.name}</option>`;
	});
	listHazards.html(retorno);
}