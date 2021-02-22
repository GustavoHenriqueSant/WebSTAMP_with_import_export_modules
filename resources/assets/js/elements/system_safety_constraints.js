var $ = require('jquery');

var hazards = [];

function addHazard(hazard) {
	hazards.push(hazard);
}

function editHazard(oldHazard, newHazard) {
	hazards.forEach(function(loss, index){
		if (hazards[index].name === oldHazard){
			hazards[index].name = newHazard;
		}
	})
}

module.exports = {
	addHazard : addHazard,
	editHazard : editHazard,
	init : init,
	showHazards : showHazards,
	showAssociatedHazards : showAssociatedHazards
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

function showAssociatedHazards(hazardsIds, sscId){
	var ids = JSON.parse("[" + hazardsIds + "]");
	var listHazards = $("#ssc_hazard-" + sscId);
	var project_type = $("#project_type").val();
	var index = 0;
	var retorno = hazards.map(function(hazard) {
		index++;
		if(ids.includes(hazard.id)){
			return `<option class="option_text" value="${hazard.id}" name="[H-${index}]" selected ="true">[H-${index}] ${hazard.name} </option>`;
		}
		return `<option class="option_text" value="${hazard.id}" name="[H-${index}]">[H-${index}] ${hazard.name}</option>`;
	});
	listHazards.html(retorno);
}