<?php

require_once dirname(__FILE__) . '/../config.php';

function addLogRecord( $vars ) {
		var_dump( $vars );

	$wiki = isset( $vars['wiki']) ? $vars['wiki'] : '';
	$pageId = isset($vars['page']) ? $vars['page'] : '';
	$revId = isset($vars['rev']) ? $vars['rev'] : '';
	$numLinks = isset($vars['num']) ? $vars['num'] : '';
	$botId = isset($vars['id']) ? $vars['id'] : '';
	$service = isset($vars['service']) ? $vars['service'] : '';
	$status = isset($vars['status']) ? $vars['status'] : '';

	$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

	$query = "INSERT INTO bot_log (wiki, page_id, rev_id, num_links, bot_id, service, status)
	          VALUES ( '$wiki' , '$pageId' , '$revId' , '$numLinks' , '$botId' , '$service' , '$status' )";

	$result = mysqli_query( $link, $query );

	if ( $result ) {
		return json_encode( 'true' );
	} else {
		return json_encode( 'false' );
	}

	echo $result;
}

// $wiki = isset($_GET['wiki']) ? $_GET['wiki'] : '';
// $pageId = isset($_GET['page']) ? $_GET['page'] : '';
// $revId = isset($_GET['rev']) ? $_GET['rev'] : '';
// $numLinks = isset($_GET['num']) ? $_GET['num'] : '';
// $botId = isset($_GET['id']) ? $_GET['id'] : '';
// $service = isset($_GET['service']) ? $_GET['service'] : '';
// $status = isset($_GET['status']) ? $_GET['status'] : '';
