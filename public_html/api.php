<?php

require_once dirname(__FILE__) . '/../config.php';

function addLogRecord( $vars, $link ) {
	$wiki      = isset( $vars['wiki'] ) ? $vars['wiki'] : '';
	$pageId    = isset( $vars['page'] ) ? $vars['page'] : '';
	$revId     = isset( $vars['rev'] ) ? $vars['rev'] : '';
	$fixed     = isset( $vars['fixed'] ) ? $vars['num'] : '';
	$notFixed  = isset( $vars['notfixed'] ) ? $vars['num'] : '';
	$bot       = isset( $vars['bot'] ) ? $vars['bot'] : '';
	$service   = isset( $vars['service'] ) ? $vars['service'] : '';
	$status    = isset( $vars['status'] ) ? $vars['status'] : '';
	$pageTitle = isset( $vars['title'] ) ? $vars['title'] : '';

	$query = "INSERT INTO bot_log ( wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title )
	          VALUES ( '$wiki' , '$pageId' , '$revId' , '$fixed', '$notFixed' , '$bot' , '$service' , '$status', '$pageTitle' )";

	$result = mysqli_query( $link, $query );

	if ( $result ) {
		return json_encode( 'true' );
	} else {
		return json_encode( 'false' );
	}

}
