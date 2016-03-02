// Get context with jQuery - using jQuery's .get() method.
function displayChart( keys, values ) {
	console.log( keys, values );
	var ctx = $( '#bot-chart' ).get( 0 ).getContext( '2d' );
	var data = {
		labels: keys,
		datasets: [
			{
				label: "Bot activity chart",
				fillColor: "rgba(225, 193, 223, 1)",
				strokeColor: "rgba(207, 155, 203, 1)",
				pointColor: "rgba(169, 81, 163, 1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(207, 155, 203, 1)",
				data: values
			}
		]
	};
	var myLineChart = new Chart( ctx ).Line( data );
}

