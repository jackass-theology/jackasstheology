/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { Button, Dashicon, Popover } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { compose, withState } from '@wordpress/compose';
import { withSelect } from '@wordpress/data';

/**
 * Internal dependencies
 */
import { AdminBarFill } from '@ithemes/security.dashboard.api';
import { doesElementBelongToPanel } from '../../utils';
import Panel from '../panel';
import './style.scss';

function AdminBar( { notices, noticesLoaded, isToggled, setState } ) {
	return (
		<AdminBarFill>
			<div className="itsec-admin-bar__admin-notices">
				<div className={ classnames( 'itsec-admin-bar-admin-notices__trigger', { 'itsec-admin-bar-admin-notices__trigger--has-notices': notices.length > 0 } ) }>
					<Button aria-expanded={ isToggled } onClick={ () => setState( { isToggled: ! isToggled } ) }>
						<Dashicon icon="megaphone" size={ 15 } />
						{ __( 'Notifications', 'it-l10n-ithemes-security-pro' ) }
					</Button>
					{ isToggled && (
						<Popover
							className="itsec-admin-bar-admin-notices__content"
							expandOnMobile
							focusOnMount="container"
							position="bottom left"
							headerTitle={ __( 'Notifications', 'it-l10n-ithemes-security-pro' ) }
							onClose={ () => setState( { isToggled: false } ) }
							onClickOutside={ ( e ) => {
								if (
									e.target.id !== 'itsec-admin-notices-toolbar-trigger' &&
									e.target.parentNode.id !== 'itsec-admin-notices-toolbar-trigger' &&
									! doesElementBelongToPanel( e.target )
								) {
									setState( { isToggled: false } );
								}
							} }
						>
							<Panel notices={ notices } loaded={ noticesLoaded } close={ () => setState( { isToggled: false } ) } />
						</Popover>
					) }
				</div>
			</div>
		</AdminBarFill>
	);
}

export default compose( [
	withSelect( ( select ) => ( {
		notices: select( 'ithemes-security/admin-notices' ).getNotices(),
		noticesLoaded: select( 'ithemes-security/admin-notices' ).areNoticesLoaded(),
	} ) ),
	withState( { isToggled: false } ),
] )( AdminBar );
