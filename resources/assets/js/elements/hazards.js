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
	var retorno = accidents.map(function(accident) {
		return `<option value="${accident.id}">[A-${accident.id}] ${accident.name}</option>`;
	});
	listAccidents.html(retorno);
}