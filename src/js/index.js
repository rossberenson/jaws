/**
 * Site JS
 */

function importAll(r) {
	r.keys().forEach(r);
}

import './global';
import './template-tags';
import './blocks';

importAll(require.context('../../components/', true, /\/script\.js$/));
