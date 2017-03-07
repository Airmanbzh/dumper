var ready = function (f){
	/in/.test(document.readyState) ? setTimeout('ready(' + f + ')', 9) : f();
};

ready(function(){
	var complexElements = document.getElementsByClassName("complex"),
		length = complexElements.length;
	
	if (length) {
		for (var i = 0; i < length; i++) {
			addListener(complexElements[i], 'click', onClick);
		}
	}
});

var onClick = function(e) {
	var target = arguments[0].target;
	
	if (target.tagName.toLowerCase() === 'span') {
		target = target.parentElement;
	}
	target = target.parentElement;
	
	var ulList = target.getElementsByTagName("ul");
	
	if (ulList.length) {
		var ul = ulList[0],
			className = ul.className;
		
		if (className.indexOf('expand') > -1) {
			className = className.replace('expand', '');
		} else {
			className += ' expand';
		}
		
		className = className.replace('  ', ' ');
		
		ul.className = className;
	}
	
	e.stopPropagation();
};

var addListener = function(element, eventName, handler) {
	if (element.addEventListener) {
		element.addEventListener(eventName, handler, false);
	}
	else if (element.attachEvent) {
		element.attachEvent('on' + eventName, handler);
	}
	else {
		element['on' + eventName] = handler;
	}
};

var removeListener = function(element, eventName, handler) {
	if (element.removeEventListener) {
		element.removeEventListener(eventName, handler, false);
	}
	else if (element.detachEvent) {
		element.detachEvent('on' + eventName, handler);
	}
	else {
		element['on' + eventName] = null;
	}
};