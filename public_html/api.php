<?php

require_once dirname(__FILE__) . '/../config.php';

function addLogRecord( $vars, $link ) {
	$wiki = isset( $vars['wiki'] ) ? $vars['wiki'] : '';
	$pageId = isset( $vars['page'] ) ? $vars['page'] : '';
	$revId = isset( $vars['rev'] ) ? $vars['rev'] : '';
	$numLinks = isset( $vars['num'] ) ? $vars['num'] : '';
	$botId = isset( $vars['id'] ) ? $vars['id'] : '';
	$service = isset( $vars['service'] ) ? $vars['service'] : '';
	$status = isset( $vars['status'] ) ? $vars['status'] : '';
	$pageTitle = isset( $vars['title'] ) ? $vars['title'] : '';

	$query = "INSERT INTO bot_log ( wiki, page_id, rev_id, num_links, bot_id, service, status, page_title )
	          VALUES ( '$wiki' , '$pageId' , '$revId' , '$numLinks' , '$botId' , '$service' , '$status', '$pageTitle' )";

	$result = mysqli_query( $link, $query );

	if ( $result ) {
		echo "Woot!";
		return json_encode( 'true' );
	} else {
		return json_encode( 'false' );
	}

}
