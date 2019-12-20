/**
 * WordPress dependencies
 */
import { setLocaleData } from '@wordpress/i18n';
import { render } from '@wordpress/element';
import domReady from '@wordpress/dom-ready';

setLocaleData( { '': {} }, 'it-l10n-ithemes-security-pro' );

/**
 * Internal dependencies
 */
import App from './dashboard/app.js';

domReady( () => render( <App />, document.getElementById( 'itsec-dashboard-root' ) ) );
