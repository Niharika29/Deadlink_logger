// Get context with jQuery - using jQuery's .get() method.
function displayChart( fixed, fvalues, nvalues ) {
	// console.log( keys, values );
	var ctx = $( '#bot-chart' ).get( 0 ).getContext( '2d' );
	var data = {
		labels: fixed,
		datasets: [
			{
				label: "Bot links fixed chart",
				fillColor: "rgba(225, 193, 223, 1)",
				strokeColor: "rgba(207, 155, 203, 1)",
				pointColor: "rgba(169, 81, 163, 1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(207, 155, 203, 1)",
				data: fvalues
			},
			{
				label: "Bot links not fixed chart",
				// fillColor: "rgba(165, 248, 176, 1)",
				strokeColor: "rgba(16, 218, 43, 1)",
				pointColor: "rgba(63, 171, 78, 1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(63, 171, 78, 1)",
				data: nvalues
			}
		]
	};
	var myLineChart = new Chart( ctx ).Line( data );
}

