<?php

require_once dirname(__FILE__) . '/../../config.php';

$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );
$vars = $_GET;
foreach( $vars as $key => $value ) {
	$vars[$key] = trim( mysqli_real_escape_string( $link, $value ) );
}

$query = $vars['query'];

if ( $query == 'true' && $vars['wiki'] !== null && $vars['id'] !== null ) {
	$wiki = $vars['wiki'];
	$page_id = $vars['id'];
	echo $wiki, $page_id, $credentials['user'];
	$query = "SELECT * FROM bot_log WHERE wiki = '$wiki' AND page_id = $page_id LIMIT 1";
	echo '-------', $query;
	$result = mysqli_query( $link, $query );
	if ( $result->num_rows > 0 ) {
		$data = array();
		$row = $result->fetch_assoc();
		var_dump( $row );
		foreach ( $row as $key => $value ) {
			$data[$key] = $value;
		}
		var_dump( $data );
	} else {
		echo json_encode( 'false' );
	}
} else {
	echo json_encode( 'false' );
}
