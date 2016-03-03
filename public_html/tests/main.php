<?php

require_once dirname(__FILE__) . '/../api.php';
require_once dirname(__FILE__) . '/../../config.php';

$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

$vars = array(
		'wiki' => 'dummy.wikitest.org',
		'bot' => 'Dummy',
		'title' => 'Dummier',
		'numf' => 4,
		'numn' => 5,
		'pass' => $credentials['password']
 );

// Add the test record
addLogRecord( $vars, $link, $credentials['password'] );

// Query to see it was inserted
$query = 'SELECT * FROM bot_log WHERE wiki="dummy.wikitest.org"';
$result = mysqli_query( $link, $query );

assert( $result->num_rows == 1 );

// Validate insertion
if ( $result->num_rows > 0 ) {
	$row = $result->fetch_assoc();
	assert( $row['wiki'] == 'dummy.wikitest.org' );
	assert( $row['bot'] == 'Dummy' );
	assert( $row['page_title'] == 'Dummier' );
	assert( $row['links_fixed'] == 4 );
	assert( $row['links_not_fixed'] == 5 );
} else {
	echo 'Test failed';
	die();
}

// Delete test record
$query2 = 'DELETE FROM bot_log WHERE wiki="dummy.wikitest.org"';
$result2 = mysqli_query( $link, $query2 );
echo 'Test succesful';
