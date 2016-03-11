<?php

require_once dirname(__FILE__) . '/../../config.php';

$vars = $_GET;
foreach( $vars as $key => $value ) {
	$vars[$key] = trim( mysqli_real_escape_string( $value ) );
}

// Case 1: wiki and page id given - get details about when last parsed and by which bot etc.
if ( $vars['wiki'] !== null && $vars['id'] !== null ) {
	$wiki = $vars['wiki'];
	$page_id = $vars['id'];
	$query = "SELECT * FROM bot_log WHERE wiki = '$wiki' AND page_id = $page_id LIMIT 1";
	generateResult( $query );
// Case 2: wiki and bot given - check which page last parsed by bot on that wiki
} elseif ( $vars['wiki'] !== null && $vars['bot'] !== null ) {
	$wiki = $vars['wiki'];
	$bot = $vars['bot'];
	$query = "SELECT * FROM bot_log WHERE wiki = '$wiki' AND bot = '$bot' LIMIT 1";
	generateResult( $query );
// Case 3: bot given - check which page last edited on which wiki and when by the bot
} elseif ( $vars['bot'] !== null ) {
	$bot = $vars['bot'];
	$query = "SELECT * FROM bot_log WHERE bot = '$bot' LIMIT 1";
	generateResult( $query );
}

function generateResult( $query ) {
	$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );
	$result = mysqli_query( $link, $query );
	var_dump( $credentials['host'] );
	if ( $result->num_rows > 0 ) {
		$row = $result->fetch_assoc();
		echo json_encode( $row );
	} else {
		echo json_encode( 'false' );
	}
}
