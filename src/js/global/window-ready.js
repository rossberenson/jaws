/**
 * File window-ready.js
 *
 * Add a "ready" class to <body> when window is ready.
 */
function windowReady() {
	document.body.classList.add('ready');
}

if (
	('complete' === document.readyState || 'loading' !== document.readyState) &&
	!document.documentElement.doScroll
) {
	windowReady();
} else {
	document.addEventListener('DOMContentLoaded', windowReady);
}
