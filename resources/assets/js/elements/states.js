var $ = require('jquery');

var variables = [];

function addVariable(va) {
	variables.push(va);
}

module.exports = {
	addVariable : addVariable,
	init : init,
	showVariables : showVariables
}

function init(){
	variables = $("#variables_content").data("variables");
}

function showVariables(){
	var listVariables = $("#variable-association");
	var retorno = variables.map(function(variable) {
		return `<option value="${variable.id}">${variable.name}</option>`;
	});
	listVariables.html(retorno);
}