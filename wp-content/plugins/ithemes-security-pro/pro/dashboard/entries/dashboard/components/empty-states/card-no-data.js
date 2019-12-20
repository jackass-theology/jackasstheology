/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import Icon from './icons/card-no-data.svg';

export default function CardNoData() {
	return (
		<div className="itsec-empty-state-card itsec-empty-state-card--no-data">
			<h3>{ __( 'No data to report...', 'it-l10n-ithemes-security-pro' ) }</h3>
			<Icon />
			<p>{ __( 'There is no data to report yet. Don\'t worry, this does not mean there is an issue.', 'it-l10n-ithemes-security-pro' ) }</p>
		</div>
	);
}
