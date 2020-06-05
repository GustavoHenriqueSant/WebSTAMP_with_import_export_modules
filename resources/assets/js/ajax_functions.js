var Hazard = require('./elements/hazards');
Hazard.init();

var axios = require('./axios');
var $ = require('jquery');
var loss = require('./templates/loss_template');

function addLoss() {
	
}

module.exports = {
	addLoss: addLoss
}