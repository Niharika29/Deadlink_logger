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
				strokeColor: "#b47ec8",
				pointColor: "#7f4096",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "#b47ec8",
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
	// var options = {
	// 	legendTemplate : "<ul><li><span style=\"background-color:#b47ec8\"></span>Links fixed</li><li><span style=\"background-color:#ef9048\"></span>Links fixed</li></ul>",
	// }
	var myLineChart = new Chart( ctx ).Line( data );
	$( '#legend' ).html( myLineChart.generateLegend() );
}

