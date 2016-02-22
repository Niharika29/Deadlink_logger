<?php

require_once( 'api.php' );
require_once dirname(__FILE__) . '/../config.php';

if ( isset( $_GET['id'] ) ) {
	$vars = $_GET;
	$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );
	addLogRecord( $vars, $link );
} else {
	// Frontend graph stuff goes here.
}
