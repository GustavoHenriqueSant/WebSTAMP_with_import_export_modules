var Hazard = require('./elements/hazards');
var Drop = require('tether-drop');
Hazard.init();
var fundamentals = ['hazard', 'component', 'systemgoal', 'accident', 'controlaction', 'variable', 'state'];

fundamentals.forEach(function(f) {
  var drop = new Drop({
    target: document.querySelector('[data-add="' + f + '"]'),
    content: document.querySelector('[data-drop="' + f + '"]'),
    openOn: 'click',
    tetherOptions: {
      attachment: 'top left',
      targetAttachment: 'middle right',
      constraints: [
        {
          to: 'scrollParent',
          attachment: 'together'
        }
      ]
    }
  });
  drop.on("open", function() {
    if (f === "hazard"){
      Hazard.showAccidents();
    }
  })
});

var accident = require('./templates/accident_template');
var axios = require('./axios');

var $ = require('jquery');
$('body').on('submit', '.add-form', function(event) {
  event.preventDefault();
  var form = $(event.currentTarget);
  var activity = form.data("add");
  var activity_name = activity + '-name';
  var name = form.find("#" + activity_name).val();
  if (activity === 'accident') {
    var $newAccident = $('#accidents').find(".substep__list");
    axios.post('/addaccident', {
      name: name,
      id : 4
    })
    .then(function (response) { 
      console.log(response);
      Hazard.addAccident(response.data);
      $newAccident.append(accident(response.data));
    })
    .catch(function (error) {
      console.log(error);
    });
  }
  return false;
});
