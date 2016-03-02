// Get context with jQuery - using jQuery's .get() method.
function displayChart( fixed, fvalues, nvalues ) {
	// console.log( keys, values );
	var ctx = $( '#bot-chart' ).get( 0 ).getContext( '2d' );
	var data = {
		labels: fixed,
		datasets: [
			{
				label: "Bot links fixed chart",
				fillColor: "rgba(0, 0, 0, 0)",
				strokeColor: "rgba(207, 155, 203, 1)",
				pointColor: "rgba(169, 81, 163, 1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(207, 155, 203, 1)",
				data: fvalues
			},
			{
				label: "Bot links not fixed chart",
				fillColor: "rgba(0, 0, 0, 0)",
				strokeColor: "#ef9048",
				pointColor: "#b75810",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "#b75810",
				data: nvalues
			}
		]
	};
	var myLineChart = new Chart( ctx ).Line( data );
}

