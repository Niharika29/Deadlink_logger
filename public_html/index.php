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
}

?>
	<form name="f1" method="post">
		<select name="time">
			<option value="lweek" selected>Last week</option>
			<option value="lmonth">Last month</option>
			<option value="lyear">Last year</option>
		</select>

		<select name="lang">
			<option value="en" selected>en</option>
			<option value="en">de</option>
			<option value="en">fr</option>
			<option value="en">hi</option>
			<option value="en">he</option>
			<option value="en">es</option>
		</select>

		<select name="wiki">
			<option value="wikipedia" selected>wikipedia</option>
			<option value="wikisource">wikisource</option>
			<option value="wikinews">wikinews</option>
		</select>

		<select name="bot">
			<option value="all" selected>All bots</option>
			<option value="1">Bot 1</option>
			<option value="2">Bot 2</option>
			<option value="3">Bot 3</option>
		</select>

		<input type="submit" name="submit" value="Go" />
	</form>

<?php

else {
	// Frontend graph stuff goes here.
	if ( isset( $_POST['submit'] ) ) {
		$ftime = $_POST['time'];
		echo "You have chosen ". $ftime;
		$lang = $_POST['lang'];
		echo "You have chosen ". $lang;
		$wiki = $_POST['wiki'];
		echo "You have chosen ". $wiki;
		$bot = $_POST['bot'];
		echo "You have chosen ". $bot;
	}
	echo 'Test';
}

