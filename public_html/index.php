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

$bot = 'all';
$lang = 'en';
$wiki = 'wikipedia';
$time = 'lweek';

	$html = "<form name='f1' method='post'>
		<select name='time'>
			<option value='lweek' if( ". $_POST['time'] ." == 'lweek' ) 'selected';>Last week</option>
			<option value='lmonth' if( ". $_POST['time'] ." == 'lmonth' ) 'selected';>Last month</option>
			<option value='lyear' if( ". $_POST['time'] ." == 'lyear' ) 'selected';>Last year</option>
		</select>

		<select name='lang'>
			<option value='en' if( ". $_POST['lang'] ." == 'en' ) 'selected';>en</option>
			<option value='de' if( ". $_POST['lang'] ." == 'de' ) 'selected';>de</option>
			<option value='fr' if( ". $_POST['lang'] ." == 'fr' ) 'selected';>fr</option>
			<option value='hi' if( ". $_POST['lang'] ." == 'hi' ) 'selected';>hi</option>
			<option value='he' if( ". $_POST['lang'] ." == 'he' ) 'selected';>he</option>
			<option value='es' if( ". $_POST['lang'] ." == 'es' ) 'selected';>es</option>
		</select>

		<select name='wiki'>
			<option value='wikipedia if( ". $_POST['wiki'] ." == 'wikipedia' ) 'selected';>wikipedia</option>
			<option value='wikisource' if( ". $_POST['wiki'] ." == 'wikisource' ) 'selected';>wikisource</option>
			<option value='wikinews' if( ". $_POST['wiki'] ." == 'wikinews' ) 'selected';>wikinews</option>
		</select>

		<select name='bot'>
			<option value='all' if( ". $_POST['bot'] ." == 'all' ) 'selected';>All bots</option>
			<option value='1' if( ". $_POST['bot'] ." == '1' ) 'selected';>Bot 1</option>
			<option value='2' if( ". $_POST['bot'] ." == '2' ) 'selected';>Bot 2</option>
			<option value='3' if( ". $_POST['bot'] ." == '3' ) 'selected';>Bot 3</option>
		</select>

		<input type='submit' name='submit' value='Go' />
	</form>";

if ( isset( $_GET['id'] ) ) {
	$vars = $_GET;
	addLogRecord( $vars, $link );
} else {
	// Frontend graph stuff goes here.
	if ( isset( $_POST['submit'] ) ) {
		$time = $_POST['time'];
		$lang = $_POST['lang'];
		$wiki = $_POST['wiki'];
		$bot = $_POST['bot'];
		$url = $lang . '.' . $wiki . '.' . 'org';
		if ( $time == 'lweek' ) {
			$timeDiff = 'DATEADD(DAY, -7, GETDATE())';
		} else if ( $time == 'lmonth' ) {
			$timeDiff = 'DATEADD(DAY, -30, GETDATE())';
		} else {
			$timeDiff = 'DATEADD(DAY, -365, GETDATE())';
		}
		if ( $bot == 'all' ) {
			$query = 'SELECT * FROM bot_log WHERE wiki = "' . $url . '" AND datetime >= "'. $timeDiff .'"';
		} else {
			$query = 'SELECT * FROM bot_log WHERE wiki = "'. $url .'" AND datetime >= "'. $timeDiff .'" AND bot_id = "'. $bot .'"';
		}
		$result = mysqli_query( $link, $query );
		if ( $result->num_rows > 0 ) {
			$html .= '<table>';
			while ( $row = $result->fetch_assoc() ) {
				$html .= '<tr>'
							.'<td>'. $row['wiki'] .'</td>'
							.'<td>'. $row['bot_id'] .'</td>'
							.'<td>'. $row['page_title'] .'</td>'
						.'</tr>';
			}
			$html .= '</table>';
		}
	}
}

echo $html;

?>
