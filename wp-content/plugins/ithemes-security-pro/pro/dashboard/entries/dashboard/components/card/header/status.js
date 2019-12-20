/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

export default function Status( { status = 'protected' } ) {
	switch ( status ) {
		case 'protected':
			status = __( 'Protected', 'it-l10n-ithemes-security-pro' );
			break;
	}

	return (
		<span className="itsec-card-header-status">
			<span className="itsec-card-header-status__label">{ __( 'Status', 'it-l10n-ithemes-security-pro' ) }</span>
			<span className="itsec-card-header-status__status">{ status }</span>
		</span>
	);
}
