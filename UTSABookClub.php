
<html>
<head>
<title>UTSA Book Club</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script src="barchart.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="BookClub.css">
<img height="150" class="rt" src="RoadRunner.png" alt="My Book Club" title="UTSA Book Club"/>
</head>
<?php?>
<body bgcolor="SteelBlue">
<center><h1 class="hs">UTSA Book Club</h1></center>
<form action="http://google.com" method="get">
<p><input type="button" onclick="window.location.href = 'login.php';" name="login" value="LOGIN"/> 
   <input type="button" onclick="window.location.href = 'signup.php';" name="signup-submit" value="REGISTER"/>
</p>
</form>
<hr/>
<center><div id="container"> <p class="ps">Come and check out UTSA's best club in town. We get together
                                   to read some of the best books around today. We provide FREE
								   food and drinks every Tuesday and Thursday! There's nothing better
								   in life than reading a book and gaining knowledge.</p> 
</div>
</center>
<br/>
<img class="hp" src="HarryPotter.png"/> <img class="fs" src="Frankenstein.png"/>
<br/>
<br/>
<div id="container2"><h2>TUESDAY: </h2><p class="c"><strong>We are finishing the month by completing the last two chapters of 
										   Harry Potter and the Prisoner of Azkaban this Tuesday!</strong>
</div>
<div id="container3"><h2>THURSDAY: </h2><p class="c"><strong>We're beginning October by reading chapters 1-3 of the classic novel by Mary Shelly
                                                             entitled Frankenstein released in 1818.</strong>
</div>

<div>

<table style="width:30%; 
    margin-left:470px;
	text-align: center;">
<tr>
<th>First</th>
<th>Last</th>
<th>IsAdmin</th>
<th>username</th>
<th>college</th>
<th>Id</th>
<th>date</th>
<?php
include_once('db.php');
//function db_open($url, $db, $user, $pw)
if($_COOKIE['username'] != NULL){
$username = $_COOKIE['username'];
$conn = db_open('easel2.fulgentcorp.com','fgd806', 'fgd806', 'Evlv3h7MzBF30ay967IS');

$sql = "SELECT First, Last, IsAdmin, username, college, Id, date FROM Users WHERE username='$username'";

$result = db_query($conn, $sql);
$rows = db_num_rows($result);
if($rows > 0){
	while (($row = db_fetch($result)) != NULL) {
		echo "<tr><td>" . $row["First"] . "</td><td>" . $row["Last"] . "</td><td>" . $row["IsAdmin"] . "</td><td>" . $row["username"] . "</td><td>" . $row["college"] . "</td><td>" . $row["Id"] . "</td><td>" . $row["date"] . "</td></tr>";
	}
	echo "</table>";
}
else {
	echo "0 result";
}
}
?>
<?php 
	$sql = "SELECT college from Users;";
      $result = db_query($conn, $sql);
	  $rows = db_num_rows($result);
	  
	  $Education = 0;
	  $Engineering = 0;
	  $FineArts = 0;
	  $Business = 0;
	  $Architecture = 0;
	  $Sciences = 0;
	  if($rows > 0){
	while (($row = db_fetch($result)) != NULL){
		if($row['college']=="Education"){
			$Education = $Education + 1;
		}
		if($row['college']=="Engineering"){
			$Engineering = $Engineering + 1;
		}
		if($row['college']=="Fine Arts"){
			$FineArts = $FineArts + 1;
		}
		if($row['college']=="Business"){
			$Business = $Business + 1;
		}
		if($row['college']=="Sciences"){
			$Sciences = $Sciences + 1;
		}
		if($row['college']=="Architecture"){
			$Architecture = $Architecture + 1;
		}
	}
	  }
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<h2> NUMBER OF MEMBERS IN EACH COLLEGE

<br>
<br>

<canvas id="cnvs" width="650" height="400"></canvas>
<script type="text/javascript">
	barData = [{lbl: "Fine Arts", val: <?php echo $FineArts/100;?>}, {lbl: "Business", val: <?php echo $Business/$rows;?>}, {lbl: "Education", val: <?php echo $Education/$rows;?>}, {lbl: "Engineering", val: <?php echo $Engineering/$rows;?>}, {lbl: "Architecture", val: <?php echo $Architecture/$rows;?>}, {lbl: "Sciences", val: <?php echo $Sciences/$rows;?>}];
	barChart("cnvs", barData);
</script>

</body>

</html>