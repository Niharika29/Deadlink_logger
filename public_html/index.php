<?php

require_once( 'api.php' );
require_once dirname(__FILE__) . '/../config.php';

$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ( isset( $_GET['id'] ) ) {
	$vars = $_GET;
	addLogRecord( $vars, $link );
} else {
	// Frontend graph stuff goes here.
	if ( isset( $_POST['submit'] ) ) {
		$ftime = $_POST['time'];
		echo "You have chosen ". $ftime;
	}
	echo 'Test';
}

?>
	<form name="f1" method="post">
		<select name="time">
			<option value="lweek" selected>Last week</option>
			<option value="lmonth" selected>Last month</option>
			<option value="lyear" selected>Last year</option>
		</select>
		<input type="submit" name="submit" value="Go" />
	</form>

