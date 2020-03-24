(function (window, document) {
    "use strict";
	var textarea = document.getElementById("commentFormText"),
		sField = document.getElementById("searchField");

	// banner animation
	function introAnimation() {
		var introBlend = document.getElementById("intro"),
			term = "introAnimation";
		window.setTimeout(function () {
			if (introBlend.className.match(term)) {
				introBlend.className = introBlend.className.replace(term, "");
			} else {
				introBlend.className += term;
			}
		}, 50);
	}
	
	// change tabindex
	function changeTabindex() {
		var items = document.body.querySelectorAll('a, button, input, textarea');
	
		items.forEach(function (item) {
			if (item.tabIndex < 0) {
				item.tabIndex = 0;
			} else {
				item.tabIndex = -1;
			}
		});
	}
	// close search field on ESC
	function escapeKey(e) {
		if ((e.key === "Escape" || e.keyCode === 27) && (sField.value === sField.defaultValue)) {
			toggleClass();
		}
	}
	// search field toggle
	function toggleClass() {
		var sBox = document.getElementById("searchBox"),
			term = 'focus';
		
		if (sBox.className.match(term)) {
			sBox.className = sBox.className.replace(term, "");
			sField.blur();
			document.removeEventListener("keydown", escapeKey);
			changeTabindex();
		} else {
			sBox.className += term;
			sField.focus();
			document.addEventListener("keydown", escapeKey);
			changeTabindex();
		}
	}

	// auto grow of comment textarea
	function textareaGrow() {
		var rowValue = 0;
		while (textarea.clientHeight < textarea.scrollHeight) {
			rowValue = parseInt(textarea.getAttribute('rows'), 10) + 1;
			textarea.setAttribute('rows', rowValue);
		}
	}

	// events
	window.addEventListener("DOMContentLoaded", introAnimation, false);
	document.getElementById("searchButton").addEventListener("click", toggleClass, false);
	document.getElementById("searchClose").addEventListener("click", toggleClass, false);
	if (textarea) {
		textarea.addEventListener("input", textareaGrow, false);
	}
	
}(window, document));