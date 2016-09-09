var Hazard = require('./elements/hazards');
Hazard.init();

var axios = require('./axios');
var $ = require('jquery');
var accident = require('./templates/accident_template');

function addAccident() {
	
}

module.exports = {
	addAccident : addAccident
}