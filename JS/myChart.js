	var type = "column";
//-------------------------------------------------------!     TITLE     !------------------------------------------------
	var title = {
		text: "This is my first line chart" ,
		backgroundColor:"blue",
		borderColor:"red",
		borderThickness:2,
		cornerRadius:10,
		padding:10,
	};
//-------------------------------------------------------!   SUB TITLE   !------------------------------------------------
	var subtitle;// = {
	// 	text:"subtitle",
	// 	backgroundColor:"yellow",
	// 	borderColor:"brown",
	// 	borderThickness:2,
	// 	cornerRadius:10,
	// 	padding:10,
	// };
//-------------------------------------------------------!     LEGEND    !------------------------------------------------
	var legend = {
		horizontalAlign:"right",
		verticalAlign:"top",
		//cursor:"pointer"
		//reversed:true,
		maxWidth:200,
		dockInsidePlotArea:true,			// it allows you to .....
		fontFamily:"serif"
	};
//-------------------------------------------------------!    TOOL TIP   !------------------------------------------------
	var toolTip = {
		enabled:true,
		shared: true,					// it allows you to show all data in one toolTip	
		borderColor:"black",
		borderThickness:5,
		cornerRadius:10,
		backgroundColor:"pink",
		fontWeight:"bold",
		//fontColor:"red",
		fontSize:22,
		fontFamily:"serif"
	};
//-------------------------------------------------------!  DATA POINTS  !------------------------------------------------
	var dataPoints1  = [
		{label: "a", y:10},
		{label: "b", y:5},
		{label: "c", y:90},
		{label: "d", y:30},
		{label: "e", y:40.3}
	];
	var dataPoints2  = [
		{label: "a", y:10},
		{label: "b", y:15},
		{label: "c", y:39},
		{label: "d", y:73},
		{label: "e", y:54.5}
	];
	var dataPoints3  = [
		{label: "a", y:30},
		{label: "b", y:55},
		{label: "c", y:49},
		{label: "d", y:36},
		{label: "e", y:24.7}
	];
	var dataPoints4  = [
		{label: "a", y:80},
		{label: "b", y:35},
		{label: "c", y:79},
		{label: "d", y:13},
		{label: "e", y:42.3}
	];
	var dataPoints5  = [
		{label: "Ashok", y:31},
		{label: "b", y:43},
		{label: "c", y:97},
		{label: "d", y:53},
		{label: "e", y:10.2}
	];

//-------------------------------------------------------!  DATA SERIES  !------------------------------------------------
	var dateSeries1 = {
		type,
		color:"blue",
		showInLegend:true,				// it allows you to show legend
		bevelEnabled:true,				// it allows you to show like 3d column
		legendText:"my name",
		dataPoints:dataPoints1			//dataPoints must be an array
	};

	var dateSeries2 = {
		type,
		color:"red",
		showInLegend:true,
		bevelEnabled:true,
		legendText:"dataSeries2",
		dataPoints:dataPoints2			//dataPoints must be an array
	};
	
	var dateSeries3 = {
		type,
		color:"black",
		bevelEnabled:true,
		showInLegend:true,
		legendText:"dataSeries3",
		dataPoints:dataPoints3			//dataPoints must be an array
	};
	
	var dateSeries4 = {
		type,
		color:"yellow",
		showInLegend:true,
		bevelEnabled:true,
		legendText:"dataSeries4",
		dataPoints:dataPoints4			//dataPoints must be an array
	};
	
	var dateSeries5 = {
		type,
		color:"green",
		showInLegend:true,
		bevelEnabled:true,
		legendText:"dataSeries5",
		dataPoints:dataPoints5			//dataPoints must be an array
	};

//-------------------------------------------------------!    CULTURE    !------------------------------------------------
	// var culture = {
	// 	decimalSeparator:",",
	// 	digitGroupSeparato:"."
	// }

//-------------------------------------------------------!    AXIS-X     !------------------------------------------------
	var axisX = {
		title:"days------>",
		titleWarp:false,
		margin:40,
		labelBackgroundColor:"pink",
		labelFontColor:"blue",
		labelFontSize:24,
		//labelTextAlign:"center",
		prefix:"!",
		suffix:"!",
								//------------------------------ Tick --------------------------------
		tickLength:8,
		tickColor:"red",
		tickThickness:2,
								//------------------------------ Line --------------------------------
		lineColor:"blue",
		lineThickness:3,
		lineDashType:"dash",
								//------------------------------ Grid --------------------------------
		gridColor:"red",
		gridThickness:.7,
		gridDashType:"dash"
	};

//-------------------------------------------------------!    AXIS-Y     !------------------------------------------------
	var axisY = {
		title:"Amount---->",
		//titleWarp:false,
		margin:40,
		xlabelBackgroundColor:"pink",
		labelFontColor:"blue",
		labelFontSize:24,
		//labelTextAlign:"center",
		prefix:"!",
		suffix:"!",
								//------------------------------ Tick -------------------------------
		tickLength:8,
		tickColor:"red",
		tickThickness:2,
								//------------------------------ Line -------------------------------	
		lineColor:"blue",
		lineThickness:3,
		lineDashType:"dash",
								//------------------------------ Grid -------------------------------
		gridColor:"red",
		gridThickness:.7,
		gridDashType:"dash"
	};

//-------------------------------------------------------!   ANY VAR     !------------------------------------------------
	var Any_var = {
		title,
		subtitle,
		legend,
		width:1500,
		height:720,
		axisX,
		axisY,
		//theme:"light2",
		toolTip,
		//culture,
		//interactivityEnabled:false,
		animationEnabled:true,			// it allows you to show animation
		animationDuration:5000,
		data:[dateSeries1,dateSeries2,dateSeries3,dateSeries4,dateSeries5]	//data also must be an array
	};
//----------------------------------------------------!   FUNCTION ONLOAD   !------------------------------------------------
	window.onload = function() {
		var chart = new CanvasJS.Chart("myChart",Any_var);
		chart.render();
	}
//----------------------------------------------------!   FUNCTION ONCLICK  !------------------------------------------------
	// function mychart() {
	// 	var chart = new CanvasJS.Chart("myChart",Any_var);
	// 	chart.render();
	// }
//----------------------------------------------------!         END         !------------------------------------------------
