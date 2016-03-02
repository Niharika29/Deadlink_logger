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
			$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
		} else if ( $time == 'lmonth' ) {
			$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 MONTH)';
		} else {
			$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 YEAR)';
		}
		if ( $bot == 'all' ) {
			$query = "SELECT * FROM bot_log WHERE wiki = '" . $url . "' AND datetime >= $timeDiff";
			$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( num_links ) AS totalnum
				FROM bot_log WHERE datetime >= $timeDiff
				GROUP BY CAST( datetime AS DATE )";
		} else {
			$query = "SELECT * FROM bot_log WHERE wiki = '" . $url . "' AND datetime >= $timeDiff AND bot_id = $bot";
			$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( num_links ) AS totalnum
				FROM bot_log WHERE datetime >= $timeDiff AND bot_id = $bot
				GROUP BY CAST( datetime AS DATE )";
		}
		$chartData = mysqli_query( $link, $chart );
		$data = array();
		if ( $chartData->num_rows > 0 ) {
			while ( $row = $chartData->fetch_assoc() ) {
				$data[$row['day']] = $row['totalnum'];
			}
		}
		$result = mysqli_query( $link, $query );
		if ( $result->num_rows > 0 ) {
			$html = '<table id="results">';
			$html .= '<tr>
						<th>Wiki</th>
						<th>Bot</th>
						<th>Page title</th>
						<th>Page ID</th>
						<th>Revision ID</th>
						<th>Links fixed</th>
						<th>Service used</th>
					</tr>';
			while ( $row = $result->fetch_assoc() ) {
				$html .= '<tr class="trow">'
							.'<td>'. $row['wiki'] .'</td>'
							.'<td>'. $row['bot_id'] .'</td>'
							.'<td>'. $row['page_title'] .'</td>'
							.'<td>'. $row['page_id'] .'</td>'
							.'<td>'. $row['rev_id'] .'</td>'
							.'<td>'. $row['num_links'] .'</td>'
							.'<td>'. $row['service'] .'</td>'
						.'</tr>';
			}
			$html .= '</table>';
		}
	}
}

?>
<html>
	<head>
		<title>IA bot logs</title>
		<link rel="stylesheet" type="text/css" href="css/index.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/index.js" type="text/javascript"></script>
<script type="text/javascript">
	$( document ).ready( function(){
		displayChart( <?=json_encode( array_keys( $data ) )?>, <?=json_encode( array_values( $data ) )?> );
	})
</script>
	</head>
	<body>
		<div id="form-div">
			<form name="f1" method="post">
				<select name="time">
					<option value="lweek" <?= $time == 'lweek' ? 'selected' : '' ?> >Last week</option>
					<option value="lmonth" <?= $time == 'lmonth' ? 'selected' : '' ?> >Last month</option>
					<option value="lyear" <?= $time == 'lyear' ? 'selected' : '' ?> >Last year</option>
				</select>

				<select name="lang">
					<option value="en" if( <?= $lang == 'en' ? 'selected' : '' ?> >en</option>
					<option value="de" if( <?= $lang == 'de' ? 'selected' : '' ?> >de</option>
					<option value="fr" if( <?= $lang == 'fr' ? 'selected' : '' ?> >fr</option>
					<option value="hi" if( <?= $lang == 'hi' ? 'selected' : '' ?> >hi</option>
					<option value="he" if( <?= $lang == 'he' ? 'selected' : '' ?> >he</option>
					<option value="es" if( <?= $lang == 'es' ? 'selected' : '' ?> >es</option>
				</select>

				<select name="wiki">
					<option value="wikipedia" if( <?= $wiki == 'wikipedia' ? 'selected' : '' ?> >wikipedia</option>
					<option value="wikisource" if( <?= $wiki == 'wikisource' ? 'selected' : '' ?> >wikisource</option>
					<option value="wikinews" if( <?= $wiki == 'wikinews' ? 'selected' : '' ?> >wikinews</option>
				</select>

				<select name="bot">
					<option value="all" if( <?= $bot == 'all' ? 'selected' : '' ?> >All bots</option>
					<option value="1" if( <?= $bot == '1' ? 'selected' : '' ?> >Bot 1</option>
					<option value="2" if( <?= $bot == '2' ? 'selected' : '' ?> >Bot 2</option>
					<option value="3" if( <?= $bot == '3' ? 'selected' : '' ?> >Bot 3</option>
				</select>
				<input type="submit" name="submit" id="submit" value="Go" />
			</form>
		</div>
		<canvas id="bot-chart" width="50%" height="300"></canvas>
		<?=$html?>
	</body>
</html>
