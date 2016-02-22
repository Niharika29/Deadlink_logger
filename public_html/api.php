<?php

require_once dirname(__FILE__) . '/../config.php';

$wiki = isset($_GET['wiki']) ? $_GET['wiki'] : '';
$pageId = isset($_GET['page']) ? $_GET['page'] : '';
$revId = isset($_GET['rev']) ? $_GET['rev'] : '';
$numLinks = isset($_GET['num']) ? $_GET['num'] : '';
$botId = isset($_GET['id']) ? $_GET['id'] : '';
$service = isset($_GET['service']) ? $_GET['service'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

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
