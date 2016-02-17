<?php

// Need to import config file and fetch password for db access from it

$wiki = $_GET['wiki'] ? $_GET['wiki'] : '';
$pageId = $_GET['page'] ? $_GET['page'] : '';
$revId = $_GET['rev'] ? $_GET['rev'] : '';
$numLinks = $_GET['num'] ? $_GET['num'] : '';
$botId = $_GET['id'] ? $_GET['id'] : '';
$service = $_GET['service'] ? $_GET['service'] : '';
$status = $_GET['status'] ? $_GET['status'] : '';

$link = mysqli_connect( 'host', 'user', 'password', 'deadlinks' );

$query = "INSERT INTO bot_log VALUES (" . $wiki . $pageId . $revId . $numLinks . $botId . $service . $status ")";

$result = mysqli_query( $link, $query );

?>
