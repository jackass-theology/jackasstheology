<?php

if ( ITSEC_Modules::get_setting( 'magic-links', 'lockout_bypass' ) ) {
	require_once( dirname( __FILE__ ) . '/class-magic-link-lockout-bypass.php' );
	( new ITSEC_Magic_Link_Lockout_Bypass() )->run();
}
