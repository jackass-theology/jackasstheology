/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import WrappedSection from './wrapped-section';
import Detail from './detail';

function KnownVulnerabilities( { results } ) {
	if ( ! results.entries.vulnerabilities.length ) {
		return <WrappedSection type="vulnerabilities" status="clean" description={ __( 'Known Vulnerabilities', 'it-l10n-ithemes-security-pro' ) } />;
	}

	return (
		<WrappedSection type="vulnerabilities" status="warn" description={ __( 'Known Vulnerabilities', 'it-l10n-ithemes-security-pro' ) }>
			{ results.entries.vulnerabilities.map( ( entry, i ) => {
				return entry.issues.map( ( issue, j ) => (
					<Detail key={ `${ i }-${ j }` } status="warn">
						<a href={ entry.link } target={ '_blank' }>{ issue.title }</a>
					</Detail>
				) );
			} ) }
		</WrappedSection>
	);
}

export default KnownVulnerabilities;
