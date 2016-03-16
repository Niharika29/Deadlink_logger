<?php

require_once dirname(__FILE__) . '/../config.php';

$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

$bot = 'all';
$lang = 'en';
$wiki = 'wikipedia';
$time = 'lweek';

// Frontend graph stuff goes here.
if ( isset( $_POST['submit'] ) ) {
	$time = $_POST['time'];
	$lang = $_POST['lang'];
	$wiki = $_POST['wiki'];
	$bot = $_POST['bot'];

	// Compose url from drop-downs
	$url = mysqli_real_escape_string( $link, $lang . '.' . $wiki . '.' . 'org' );
	if ( $time == 'lweek' ) {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
	} else if ( $time == 'lmonth' ) {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 MONTH)';
	} else {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 YEAR)';
	}
	if ( $bot == 'all' ) {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE wiki = '". $url ."'
				AND datetime >= $timeDiff ORDER BY datetime DESC LIMIT 100";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE datetime >= $timeDiff AND wiki = '". $url ."'
				GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
	} else {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE wiki = '". $url ."' AND datetime >= $timeDiff
				AND bot = '$bot' ORDER BY datetime DESC LIMIT 100";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE datetime >= $timeDiff AND bot = '$bot' AND wiki = '". $url ."'
				GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
	}
	$chartData = mysqli_query( $link, $chart );
	$dataf = array();
	$datan = array();
	$totalf = 0;
	if ( $chartData->num_rows > 0 ) {
		while ( $row = $chartData->fetch_assoc() ) {
			$dataf[$row['day']] = $row['numf'];
			$datan[$row['day']] = $row['numn'];
			$totalf += $row['numf'];
		}
	}
	$result = mysqli_query( $link, $query );
	$html = '';
	if ( $result->num_rows > 0 ) {
		$html .= '<table id="results">';
		$html .= '<tr>
					<th>Wiki</th>
					<th>Bot</th>
					<th>Page title</th>
					<th>Page ID</th>
					<th>Revision ID</th>
					<th>Links fixed</th>
					<th>Links not fixed</th>
					<th>Service used</th>
					<th>Date</th>
				</tr>';
		while ( $row = $result->fetch_assoc() ) {
			foreach ( $row as $key => $value) {
				$row[$key] = htmlspecialchars( $value );
			}
			$html .= '<tr class="trow">'
						.'<td><a href="https://'. $row['wiki'].'">'. $row['wiki'] .'</a></td>'
						.'<td>'. $row['bot'] .'</td>'
						.'<td><a href="https://'.$row['wiki'].'/wiki/'.$row['page_title'].'">'. $row['page_title'] .'</a></td>'
						.'<td>'. $row['page_id'] .'</td>'
						.'<td><a href="https://'.$row['wiki'].'/wiki/'.$row['page_title'].'?diff=prev&oldid='.$row['rev_id'].'">'. $row['rev_id'] .'</td>'
						.'<td>'. $row['links_fixed'] .'</td>'
						.'<td>'. $row['links_not_fixed'] .'</td>'
						.'<td>'. $row['service'] .'</td>'
						.'<td>'. $row['day'] .'</td>'
					.'</tr>';
		}
		$html .= '</table>';
	}
}

?>
<html>
	<head>
		<title>IA bot logs</title>
<script src="js/Chart.min.js" type="text/javascript"></script>
<script src="//tools-static.wmflabs.org/cdnjs/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/index.js" type="text/javascript"></script>
<script type="text/javascript">
	$( document ).ready( function(){
		displayChart( <?=json_encode( array_keys( $dataf ) )?>,
			<?=json_encode( array_values( $dataf ) )?>,
			<?=json_encode( array_values( $datan ) )?>,
			<?=$totalf?>, <?=$result ? $result->num_rows : null ?>
		);
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
					<option value="Alpha" if( <?= $bot == 'Alpha' ? 'selected' : '' ?> >Alpha</option>
					<option value="Beta" if( <?= $bot == 'Beta' ? 'selected' : '' ?> >Beta</option>
					<option value="Gamma" if( <?= $bot == 'Gamma' ? 'selected' : '' ?> >Gamma</option>
				</select>
				<input type="submit" name="submit" id="submit" value="Go" />
			</form>
		</div>
		<canvas id="bot-chart" style="width:900px;height:350px"></canvas>
		<div id="legend"></div>
		<?=$html?>
		<div id="footer"></div>
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</body>
</html>
