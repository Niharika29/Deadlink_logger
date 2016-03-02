// Get context with jQuery - using jQuery's .get() method.
function displayChart( keys, values ) {
	console.log( labels, values );
	var ctx = $( '#bot-chart' ).get( 0 ).getContext( '2d' );
	var data = {
		labels: ['24-10-2016', '25-10-2016'],
		datasets: [
			{
				label: "Bot activity chart",
				fillColor: "rgba(225, 193, 223, 1)",
				strokeColor: "rgba(207, 155, 203, 1)",
				pointColor: "rgba(169, 81, 163, 1)",
				pointStrokeColor: "rgba(126, 188, 237, 1)",
				pointHighlightFill: "rgba(41, 145, 224, 1)",
				pointHighlightStroke: "#fff",
				data: values
			}
		]
	};
	var myLineChart = new Chart( ctx ).Line( data );
}


// var data = {
// 	labels: ["January", "February", "March", "April", "May", "June", "July"],
// 	datasets: [
// 		{
// 			label: "My First dataset",
// 			fillColor: "rgba(220,220,220,0.2)",
// 			strokeColor: "rgba(220,220,220,1)",
// 			pointColor: "rgba(220,220,220,1)",
// 			pointStrokeColor: "#fff",
// 			pointHighlightFill: "#fff",
// 			pointHighlightStroke: "rgba(220,220,220,1)",
// 			data: [65, 59, 80, 81, 56, 55, 40]
// 		}
// 	]
// };

