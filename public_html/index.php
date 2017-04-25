<?php

require_once dirname(__FILE__) . '/../config.php';

$link = mysqli_connect( $credentials['host'], $credentials['user'], $credentials['pass'], $credentials['db'] );

$bot = 'all';
$wiki = 'all';
$time = 'lweek';
$html = '';
$dataf = []; // Links fixed
$datan = []; // Links not fixed
$result = [];
$totalf = 0;
$botNames = [];
$wikiNames = [];

// Default query for records on the page
$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log ORDER BY datetime DESC LIMIT 200";

// Chart data
$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
			FROM bot_log WHERE datetime >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND wiki = 'en.wikipedia.org'
			GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
$pagesQuery = "SELECT DISTINCT page_title FROM bot_log WHERE datetime >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND wiki = 'en.wikipedia.org'";

if ( isset( $_POST['submit'] ) ) {
	$time = $_POST['time'];
	$wiki = $_POST['wiki'];
	$bot = $_POST['bot'];

	if ( $time == 'lweek' ) {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
	} else if ( $time == 'lmonth' ) {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 MONTH)';
	} else {
		$timeDiff = 'DATE_SUB(CURDATE(), INTERVAL 1 YEAR)';
	}
	if ( $bot == 'all' && $wiki == 'all' ) {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE datetime >= $timeDiff ORDER BY datetime DESC LIMIT 200";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE datetime >= $timeDiff GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
		$pagesQuery = "SELECT DISTINCT page_title FROM bot_log WHERE datetime >= $timeDiff";
	} elseif ( $bot == 'all' ) {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE wiki = $wiki
				AND datetime >= $timeDiff ORDER BY datetime DESC LIMIT 200";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE wiki = $wiki AND datetime >= $timeDiff GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
		$pagesQuery = "SELECT DISTINCT page_title FROM bot_log WHERE wiki = $wiki AND datetime >= $timeDiff";
	} elseif ( $wiki == 'all' ) {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE bot = $bot
				AND datetime >= $timeDiff ORDER BY datetime DESC LIMIT 200";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE bot = $bot AND datetime >= $timeDiff GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
		$pagesQuery = "SELECT DISTINCT page_title FROM bot_log WHERE bot = $bot AND datetime >= $timeDiff";
	} else {
		$query = "SELECT *, CAST( datetime AS DATE ) AS day FROM bot_log WHERE bot = $bot AND wiki = $wiki AND
				datetime >= $timeDiff ORDER BY datetime DESC LIMIT 200";
		$chart = "SELECT datetime, CAST( datetime AS DATE ) AS day, SUM( links_fixed ) AS numf, SUM( links_not_fixed ) AS numn
				FROM bot_log WHERE datetime >= $timeDiff AND bot = $bot AND wiki = $wiki
				GROUP BY CAST( datetime AS DATE ) ORDER BY datetime ASC";
		$pagesQuery = "SELECT DISTINCT page_title FROM bot_log WHERE datetime >= $timeDiff AND bot = $bot AND wiki = $wiki";
	}
}
// Get all the bot names
$botQuery = "SELECT DISTINCT bot FROM bot_log ORDER BY bot DESC";
$botData = mysqli_query( $link, $botQuery );
if ( $botData->num_rows > 0 ) {
	while ( $row = $botData->fetch_assoc() ) {
		$botNames[] = $row['bot'];
	}
}

// Get all wikis
$wikiQuery = "SELECT DISTINCT wiki FROM bot_log ORDER BY wiki ASC";
$wikiData = mysqli_query( $link, $wikiQuery );
if ( $wikiData->num_rows > 0 ) {
	while ( $row = $wikiData->fetch_assoc() ) {
		$wikiNames[] = $row['wiki'];
	}
}

$pagesProcessed = mysqli_query( $link, $pagesQuery );

$chartData = mysqli_query( $link, $chart );
if ( $chartData->num_rows > 0 ) {
	while ( $row = $chartData->fetch_assoc() ) {
		$dataf[$row['day']] = $row['numf'];
		$datan[$row['day']] = $row['numn'];
		$totalf += $row['numf'];
	}
}
$result = mysqli_query( $link, $query );
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
		$classes = 'trow ';
		if ( $row['rev_id'] == 0 ) {
			$classes .= 'terror';
		}
		$html .= '<tr class="' . $classes . '">'
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
			<?=$totalf?>, <?=$pagesProcessed->num_rows ? $pagesProcessed->num_rows : 0 ?>
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

				<select name="wiki">
					<option value="all" if( <?= $wiki == 'all' ? 'selected' : '' ?> >All projects</option>
					<?php
						foreach ( $wikiNames as $wikiname ) {
							echo "<option value=\"$wikiname\"";
							if ( $wikiname == $wiki ) {
								echo ' selected';
							}
							echo ">$wikiname</option>";
						}
					?>
				</select>

				<select name="bot">
					<option value="all" if( <?= $bot == 'all' ? 'selected' : '' ?> >All bots</option>
					<?php
						foreach ( $botNames as $botName) {
							echo "<option value=\"$botName\"";
							if ( $bot == $botName ) {
								echo ' selected';
							}
							echo ">$botName</option>";
						}
					?>
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
