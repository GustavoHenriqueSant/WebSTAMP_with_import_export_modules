var Drop = require('tether-drop');

var fundamentals = ['hazard', 'component', 'systemgoal', 'accident', 'controlaction', 'variable', 'state'];
fundamentals.forEach(function(f) {
  new Drop({
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
});
