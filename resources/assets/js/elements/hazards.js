var $ = require('jquery');

var losses = [];

function addLoss(ac) {
	losses.push(ac);
}

function editLoss(oldLoss, newLoss) {
	losses.forEach(function(loss, index){
		if (losses[index].name === oldLoss){
			losses[index].name = newLoss;
		}
	})
}

function removeLoss(id) {
	const _losses = losses.filter(loss => {
		if (loss.id != id) {
			return loss;
		}
	});
	losses = _losses;
}

module.exports = {
	addLoss : addLoss,
	editLoss : editLoss,
	removeLoss,
	init : init,
	showLosses : showLosses,
	showAssociatedLosses : showAssociatedLosses
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
		return `<option value="${loss.id}" name="[L-${index}]">[L-${index}] ${loss.name}</option>`;
	});
	listLosses.html(retorno);
}

function showAssociatedLosses(lossesIds, hazardId){
	var ids = JSON.parse("[" + lossesIds + "]");
	var listLosses = $("#hazard_loss-" + hazardId);
	var project_type = $("#project_type").val();
	var index = 0;
	var retorno = losses.map(function(loss) {
		index++;
		if(ids.includes(loss.id)){
			return `<option class="option_text" value="${loss.id}" name="[L-${index}]" selected ="true">[L-${index}] ${loss.name} </option>`;
		}
		return `<option class="option_text" value="${loss.id}" name="[L-${index}]">[L-${index}] ${loss.name}</option>`;
	});
	listLosses.html(retorno);
}