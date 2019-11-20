<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Assignment 5</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<style type="text/css">
	td { vertical-align: top; }
	p.err { color: red; }
</style>
<script src="valid.js" type="text/javascript"></script>
</head>

<body bgcolor="lightgray">

<?php
	$year = $_REQUEST["year"];
	$mon = $_REQUEST["month"];
	$day = $_REQUEST["day"];
	
	$msg = "";
	if ($year and ($year <= 1900 or $year >= 2100)) {
		$msg = "Invalid year: " . $year . ", must be between 1901 and 2099";
	}
	
	if ($mon and ($mon <= 0 or $mon > 12)) {
		$msg = "Invalid month: " . $mon . ", must be from 1 to 12";
	}
	
	if ($day and ($day < 1 or $day > 31)) {
		$msg = "Invalid day: " . $day . ", enter a valid day";
	}
	
	if (($mon == 4 or $mon == 6 or $mon == 9 or $mon == 11) and $day > 30) {
		$msg = "Invalid day: " . $day . ", must be from 1 to 30";
	}
	
	if (($mon == 1 or $mon == 3 or $mon == 5 or $mon == 7 or $mon == 8 or $mon == 10 or $mon == 12) and $day > 31) {
		$msg = "Invalid day: " . $day . ", must be from 1 to 31";
	}
	
	//check if leap year
	if ($mon and $mon == 2 and $year % 4 == 0 and ($year > 1900 and $year < 2100) and $day > 29) {
		$msg = "Invalid day: " . $day . ", must be from 1 to 29";
	}
	
	elseif ($mon and $mon == 2 and $day > 28){
		$msg = "Invalid day: " . $day . ", must be from 1 to 28";
	}
	
	if ($year > 0 or $mon > 0 or $day > 0) {
		print "<p>Previous M/D/Y = " . $mon . "/" . $day . "/" . $year;
	}
?>


<!-- Used only for error reporting -->
<?php
	print '<p id="errmsg" class="err">' . $msg . '</p>';
?>

<form action="valid.php" method="get">
<table cellpadding="20"><tr>
	<td><b>Enter a Year:</b>
<?php
	print '  <br/><input onchange="checkDate()" type="text" id="year" name="year" width="40" value="' . $year . '"/>';
?>

	<td><b>Choose a Month:</b>
	<table border>
<?php
	print "<tr>\n";
	radio(1, "January");
	radio(5, "May");
	radio(9, "September");
	print "<tr>\n";
	radio(2, "February");
	radio(6, "June");
	radio(10, "October");
	print "<tr>\n";
	radio(3, "March");
	radio(7, "July");
	radio(11, "November");
	print "<tr>\n";
	radio(4, "April");
	radio(8, "August");
	radio(12, "December");
?>

</table>
	<td align="center"><b>Select a Day:</b>
	<br/><select onchange="checkMonth()" id="day" name="day">
		  <option value="0">none</option>

		
<?php
	for ($i=1; $i<=31; $i++) {
		$sel = "";
		if ($i == $day) $sel = " selected";
		print "		<option value='" . $i . "'" . $sel . ">" . $i . "</option>\n";
	}
?>
	</select>
	<td><input disabled id="submit" type="submit"/>
</table>
</form>

</body>
</html>

<?php
	function radio($number, $name) {
		global $mon;
		$chk = "";
		if ($number == $mon) $chk = " checked";
		print '		<td><input type="radio" name = "month" id="month-' . $number .'"  value="' . $number . '"' . $chk . '/>' . $name . "\n";
	}
?>
