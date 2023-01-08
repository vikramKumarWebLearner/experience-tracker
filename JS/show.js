function mychart(height,id) {
	//-------------------------------------------------------!    TOOL TIP   !------------------------------------------------
		var toolTip = {
			enabled:true,
			shared: true,					// it allows you to show all data in one toolTip	
			borderColor:"black",
			borderThickness:1,
			cornerRadius:10,
			backgroundColor:"white",
			fontWeight:"bold",
			//fontColor:"red",
			fontSize:22,
			fontFamily:"serif"
		};

	//-------------------------------------------------------!   ANY VAR     !------------------------------------------------
		var Any_var = {
			// title,
			// width,
			height,
			// theme:"dark1",
			toolTip,
			// interactivityEnabled:false,
			animationEnabled:true,			// it allows you to show animation
			animationDuration:1500,
			data	//data also must be an array
		};
	//----------------------------------------------------!   FUNCTION ONCLICK  !---------------------------------------------
			var chart = new CanvasJS.Chart(id,Any_var);
			chart.render();
	//----------------------------------------------------!         END         !---------------------------------------------
}
