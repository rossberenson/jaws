/**
 * Is motion ok?
 *
 * Prevent animations from running if the user has enabled 'reduce motion' on their machines.
 *
 * Use as a conditional. if ( isMotionOk ) { runAnimation(); }
 */

function checkMQ(mediaQuery) {
	return mediaQuery.matches;
}

const isMotionOk = () => {
	// Grab the prefers reduced media query.
	const mediaQuery = window.matchMedia(
		'(prefers-reduced-motion: no-preference)'
	);
	let isOk = true;

	// If there is no mediaQuery for some reason, return.
	if (!mediaQuery) {
		return false;
	}

	// On load, Check if the media query matches or is not available.
	isOk = checkMQ(mediaQuery);

	// Check for changes in the media query's value. I don't think this is a property that can change on the fly, but just incase.
	mediaQuery.addEventListener('change', () => {
		isOk = checkMQ(mediaQuery);
	});

	return isOk;
};

export default isMotionOk;
