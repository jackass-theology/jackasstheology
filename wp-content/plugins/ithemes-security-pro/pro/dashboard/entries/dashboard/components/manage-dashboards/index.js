/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { withDispatch, withSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';
/**
 * Internal dependencies
 */
import Dashboard from './dashboard';
import { getConfigValue } from '../../utils';
import './style.scss';

function ManageDashboards( { dashboards, canCreate, viewCreate, close } ) {
	const currentUserId = getConfigValue( [ 'user', 'id' ] );

	return (
		<div className="itsec-manage-dashboards">
			<header className="itsec-manage-dashboards__header">
				<h3>{ __( 'Manage Dashboards', 'it-l10n-ithemes-security-pro' ) }</h3>
				<p>{ __( 'Switch, manage, or create new dashboards.', 'it-l10n-ithemes-security-pro' ) }</p>
			</header>
			<ul className="itsec-manage-dashboards__list">
				{ dashboards.map( ( dashboard ) => (
					<Dashboard key={ dashboard.id } dashboard={ dashboard } currentUserId={ currentUserId } close={ close } />
				) ) }
			</ul>
			{ canCreate && (
				<section className="itsec-manage-dashboards__create">
					<Button isLink onClick={ () => [ viewCreate(), close() ] }>{ __( 'Create New Dashboard', 'it-l10n-ithemes-security-pro' ) }</Button>
				</section>
			) }
		</div>
	);
}

export default compose( [
	withSelect( ( select ) => ( {
		canCreate: select( 'ithemes-security/dashboard' ).canCreateDashboards(),
		dashboards: select( 'ithemes-security/dashboard' ).getAvailableDashboards(),
	} ) ),
	withDispatch( ( dispatch ) => ( {
		viewCreate: dispatch( 'ithemes-security/dashboard' ).viewCreateDashboard,
	} ) ),
] )( ManageDashboards );
