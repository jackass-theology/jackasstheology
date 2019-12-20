<?php
require_once( dirname( __FILE__ ) . '/class.itcred.php' );

class ITXAPI_Helper2 {
	
	private static function _phpass_hash_password( $password ) {
		if ( ! class_exists( 'PasswordHash' ) ) {
			require_once( dirname( __FILE__ ) . '/class-phpass.php');
		}
		
		$hasher = new PasswordHash(8, true);
		$hash = $hasher->HashPassword($password);
		
		return $hash;
		
	}
	
	// WAS: get_wordpress_phpass().
	public static function get_access_token($user, $pass, $site, $wp) {
		if ( ! class_exists( 'PasswordHash' ) ) {
			require_once( dirname( __FILE__ ) . '/class-phpass.php');
		}
		
		$source_string = $pass . $user . str_replace( 'www.', '', $site ) . $wp;
		$salted_string2 = substr( $source_string, 0, max( strlen( $pass ), 512 ) );     //  new auth with hashed passwords
		
		return self::_phpass_hash_password( $salted_string2 );
	}
	
} // End class.