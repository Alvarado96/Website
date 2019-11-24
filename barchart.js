function barChart(id, values){
	var canvas = document.getElementById(id);
	var gridScale = 100; // for the grid lines
	var padding = canvas.height * .20; // leave 20% for the bottom labels and white space
	//get the context
	var ctx = canvas.getContext("2d");
	var fontHeight = 12;
	ctx.font = fontHeight + "px Arial";
	var canvasActualHeight = canvas.height - padding; 
	
	var maxValue = 0;
	//get the maximum of the values 
	for(var i = 0; i < values.length; i++){
		maxValue = Math.max(maxValue, values[i].val);
	}
	maxValue = (maxValue * 100);
	
	var gridValue = 0;
	//draw the grid lines
	while (gridValue <= canvas.height + maxValue){
		var gridY = canvasActualHeight * (1 - gridValue/maxValue) + (padding/2); //TODO
		drawLine(ctx, 0, gridY, canvas.width, gridY, "black");
		gridValue += gridScale;
	}
	
	//draw the bars
	for(var i = 0; i < values.length; i++){
		//multiplied by 100 for actual scale number
		var val = values[i].val * 100;
		var barHeight = Math.round(canvasActualHeight * val/maxValue);
		var hue = (360 * i) / values.length;
		ctx.fillStyle = "hsl(" + hue + ", 100%, 70%)";
		var xCoord = i * canvas.width/values.length + padding / 2;
		
		// rectangle width is 1/2 of 1/n of the width of the canvas
		var recWidth = ctx.canvas.width/2 * 1/values.length; 
		
		ctx.fillRect(xCoord, canvas.height - barHeight - (padding/2), recWidth, barHeight);
		
		// writing the labels to the screen
		ctx.strokeText(values[i].lbl, xCoord + (ctx.canvas.width/2 * 1/values.length) / 4, canvas.height - padding/4);
		
	}
}

//function for drawing grid lines
function drawLine(ctx, startX, startY, endX, endY, color) {
	ctx.save();
	ctx.strokeStyle = color;
	ctx.beginPath();
	ctx.moveTo(startX, startY);
	ctx.lineTo(endX, endY);
	ctx.stroke();
	ctx.restore();
}