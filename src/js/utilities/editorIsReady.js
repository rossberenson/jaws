/**
 * Check to see if editor is ready
 *
 * @example
 * // Usage of editorIsReady function
 * editorIsReady().then(() => {
 *   // The editor is now ready for interaction.
 *   // You can perform actions that require the editor to be fully loaded.
 * });
 *
 * https://gist.github.com/KevinBatdorf/fca19e1f3b749b5c57db8158f4850eff
 */
import { select, subscribe } from '@wordpress/data';

export function editorIsReady() {
	return new Promise( ( resolve ) => {
		const unsubscribe = subscribe( () => {
			// This will trigger after the initial render blocking, before the window load event
			// This seems currently more reliable than using __unstableIsEditorReady
			if (
				select( 'core/editor' ).isCleanNewPost() ||
				select( 'core/block-editor' ).getBlockCount() > 0
			) {
				unsubscribe();
				resolve();
			}
		} );
	} );
}
