<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Main Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script src="barchart.js" type="text/javascript"></script>
</head>

<body bgcolor="lightgray">
<canvas id="cnvs" width="400" height="400"></canvas>
<script type="text/javascript">
	barData = [{lbl: "Alpha", val: 0.20}, {lbl: "Beta", val: 0.45}, {lbl: "Gamma", val: 0.35}];
	barChart("cnvs", barData);
</script>
</body>
</html>