<?php
require_once( dirname( __FILE__ ) . '/class-passwordless-login.php' );

$login_method = new ITSEC_Passwordless_Login();
$login_method->run();
