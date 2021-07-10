window.onload = function() {

	( function ( $ ) {
		"use strict";
	
		//pie chart
		var ctx = document.getElementById( "pieChart" );
		var sratus = $("#sratus_persen").val();
		var belum_sratus = $("#belum_sratus").val();
		ctx.height = 300;
		var myChart = new Chart( ctx, {
			type: 'pie',
			data: {
				datasets: [ {
					data: [ sratus, belum_sratus ],
					backgroundColor: [
										"rgba(0, 123, 255,0.9)",
										"rgb(238, 54, 54)"
									],
					hoverBackgroundColor: [
										"rgba(0, 123, 255,0.9)",
										"rgb(238, 54, 54)"
									]
	
								} ],
				labels: [
								"Tahapan Pekerjaan Sudah 100%",
								"Tahapan Pekerjaan Belum 100%"
							]
			},
			options: {
				responsive: true
			}
		} );
	
	} )( jQuery );
}
