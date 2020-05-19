var $ = require('jquery');

var losses = [];

function addLoss(ac) {
	losses.push(ac);
}

module.exports = {
	addLoss : addLoss,
	init : init,
	showLosses : showLosses
}

function init(){
	losses = $("#hazards_content").data("losses");
}

function showLosses(){
	var listLosses = $("#hazard-loss-association");
	var project_type = $("#project_type").val();
	var index = 0;
	var retorno = losses.map(function(loss) {
		index++;
		return `<option value="${loss.id}">[L-${index}] ${loss.name}</option>`;
	});
	listLosses.html(retorno);
}