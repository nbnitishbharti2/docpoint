$(function(){
	
	/* Morris Area Chart */
	
	// window.mA = Morris.Area({
	//     element: 'morrisArea',
	//     data: [
	//         { y: '2013', a: 200},
	//         { y: '2014', a: 100},
	//         { y: '2015', a: 240},
	//         { y: '2016', a: 120},
	//         { y: '2017', a: 80},
	//         { y: '2018', a: 100},
	//         { y: '2019', a: 300},
	//     ],
	//     xkey: 'y',
	//     ykeys: ['a'],
	//     labels: ['Revenue'],
	//     lineColors: ['#1b5a90'],
	//     lineWidth: 2,
		
    //  	fillOpacity: 0.5,
	//     gridTextSize: 10,
	//     hideHover: 'auto',
	//     resize: true,
	// 	redraw: true
	// });
	
	// /* Morris Line Chart */
	var data = [
		{ y: '19-02-2021', a: 50, b: 90},
		{ y: '20-02-2021', a: 65,  b: 75},
		{ y: '21-02-2021', a: 50,  b: 50},
		{ y: '22-02-2021', a: 75,  b: 60},
		{ y: '23-02-2021', a: 80,  b: 65},
		{ y: '24-02-2021', a: 90,  b: 70},
		{ y: '25-02-2021', a: 100, b: 75}
	],
	config = {
		data: data,
		xkey: 'date',
		ykeys: ['doctor', 'patient'],
		labels: ['Total Doctor', 'Total Patient'],
		fillOpacity: 0.6,
		hideHover: 'auto',
		behaveLikeLine: true,
		resize: true,
		pointFillColors:['#ffffff'],
		pointStrokeColors: ['black'],
		lineColors:['gray','red']
	};
	// config.element = 'area-chart';
	// Morris.Area(config);
	// config.element = 'line-chart';
	// Morris.Line(config);
	config.element = 'morrisArea';
	Morris.Bar(config);
	// config.element = 'stacked';
	// config.stacked = true;
	// Morris.Bar(config);
	// Morris.Donut({
	// 	element: 'pie-chart',
	// 	data: [
	// 	{label: "Friends", value: 30},
	// 	{label: "Allies", value: 15},
	// 	{label: "Enemies", value: 45},
	// 	{label: "Neutral", value: 10}
	// 	]
	// });
	window.mL = Morris.Line({
	    element: 'morrisLine',
	    data: [
	        { y: '2015', a: 100, b: 30},
	        { y: '2016', a: 20,  b: 60},
	        { y: '2017', a: 90,  b: 120},
	        { y: '2018', a: 50,  b: 80},
	        { y: '2019', a: 120,  b: 150},
	    ],
	    xkey: 'y',
	    ykeys: ['a', 'b'],
	    labels: ['Doctors', 'Patients'],
	    lineColors: ['#1b5a90','#ff9d00'],
	    lineWidth: 1,
	    gridTextSize: 10,
	    hideHover: 'auto',
	    resize: true,
		redraw: true
	});
	$(window).on("resize", function(){
		mA.redraw();
		mL.redraw();
	});

});