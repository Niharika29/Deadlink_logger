<?php

/**
 * Output API for deadlink logger. Supported params:
 * 'wiki': Wiki URL. Example: fr.wikipedia.org
 * 'pageid': ID of the page we want to query for
 * 'bot': Bot name whose last activity we want to look into
 */

require_once dirname(__FILE__) . '/../../config.php';

$vars = $_GET;
$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

foreach( $vars as $key => $value ) {
	$vars[$key] = trim( mysqli_real_escape_string( $link, $value ) );
}

// Case 1: wiki and page id given - get details about when last parsed and by which bot etc.
if ( isset( $vars['wiki'] ) && isset( $vars['pageid'] ) ) {
	$wiki = $vars['wiki'];
	$pageId = $vars['pageid'];
	$query = "SELECT * FROM bot_log WHERE wiki = '$wiki' AND page_id = $pageId LIMIT 1";
	generateResult( $query, $link );
// Case 2: wiki and bot given - check which page last parsed by bot on that wiki
} elseif ( isset( $vars['wiki'] ) && isset( $vars['bot'] ) ) {
	$wiki = $vars['wiki'];
	$bot = $vars['bot'];
	$query = "SELECT * FROM bot_log WHERE wiki = '$wiki' AND bot = '$bot' LIMIT 1";
	generateResult( $query, $link );
// Case 3: bot given - check which page last edited on which wiki and when by the bot
} elseif ( isset( $vars['bot'] ) ) {
	$bot = $vars['bot'];
	$query = "SELECT * FROM bot_log WHERE bot = '$bot' LIMIT 1";
	generateResult( $query, $link );
// Bad request
} else {
	echo json_encode( 'Invalid paramters' );
}

function generateResult( $query, $link ) {
	$result = mysqli_query( $link, $query );
	if ( $result->num_rows > 0 ) {
		$row = $result->fetch_assoc();
		echo json_encode( $row );
	} else {
		echo json_encode( 'false' );
	}
}
