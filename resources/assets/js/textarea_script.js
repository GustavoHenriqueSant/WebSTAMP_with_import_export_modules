var $ = require('jquery');

function resize(element){
	$(element).css('height','auto');
	$(element).height($(element).prop('scrollHeight') + 'px');
}

function delayedResize(element){
	window.setTimeout(function(){
		resize(element);
	}, 0);
}

$('.responsive_textarea').on({
	change: function(){
		resize(this);
	},
	cut: function(){
		delayedResize(this);
	},
	paste: function(){
		delayedResize(this);
	},
	drop: function(){
		delayedResize(this);
	},
	keydown: function(){
		delayedResize(this);
	},
	keypress: function(){
		delayedResize(this);
	}
});