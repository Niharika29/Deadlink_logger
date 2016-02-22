<?php

require_once( 'api.php' );

if( isset( $_GET['id'] ) ) {
	$vars = $_GET;
	var_dump( $vars );
	addLogRecord( $vars );
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
