/**
 * WordPress dependencies
 */
import { __, _x } from '@wordpress/i18n';

export function getTwoFactor( twoFactor ) {
	switch ( twoFactor ) {
		case 'enabled':
			return [ 'yes', __( 'Enabled', 'it-l10n-ithemes-security-pro' ) ];
		case 'not-enabled':
			return [ 'no-alt', __( 'Not Enabled', 'it-l10n-ithemes-security-pro' ) ];
		case 'enforced-not-configured':
			return [ 'minus', __( 'Enforced, Not Configured', 'it-l10n-ithemes-security-pro' ) ];
		default:
			return [ 'minus', twoFactor ];
	}
}

export function getPasswordStrength( strength ) {
	switch ( strength ) {
		case 0:
		case 1:
			return [ 'short', _x( 'Very Weak', 'password strength', 'it-l10n-ithemes-security-pro' ) ];
		case 2:
			return [ 'bad', _x( 'Weak', 'password strength', 'it-l10n-ithemes-security-pro' ) ];
		case 3:
			return [ 'good', _x( 'Medium', 'password strength', 'it-l10n-ithemes-security-pro' ) ];
		case 4:
			return [ 'strong', _x( 'Strong', 'password strength', 'it-l10n-ithemes-security-pro' ) ];
		default:
			return [ 'unknown', _x( 'Unknown', 'password strength', 'it-l10n-ithemes-security-pro' ) ];
	}
}

