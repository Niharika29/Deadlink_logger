<?php

require_once( 'api.php' );
require_once dirname(__FILE__) . '/../config.php';

if( isset( $_GET['id'] ) ) {
	$vars = $_GET;
	$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );
	addLogRecord( $vars, $link );
	// $wiki = isset($_GET['wiki']) ? $_GET['wiki'] : '';
	// $pageId = isset($_GET['page']) ? $_GET['page'] : '';
	// $revId = isset($_GET['rev']) ? $_GET['rev'] : '';
	// $numLinks = isset($_GET['num']) ? $_GET['num'] : '';
	// $botId = isset($_GET['id']) ? $_GET['id'] : '';
	// $service = isset($_GET['service']) ? $_GET['service'] : '';
	// $status = isset($_GET['status']) ? $_GET['status'] : '';

} else {
	echo "Boo!";
}
