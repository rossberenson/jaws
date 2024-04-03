const Debounce = ( func ) => {
	let timer;
	return function ( event ) {
		if ( timer ) clearTimeout( timer );
		timer = setTimeout( func, 100, event );
	};
};

export default Debounce;
