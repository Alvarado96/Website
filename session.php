// Start the session
<?php
session_start();
?>
<html>
<body>
<?php
$favColor = $_SESSION["favcolor"];
print "<p>Favorite Color was " . $favColor;
print "<p>Favorite Animal was " . $_SESSION["favanimal"];
// Set session variables
if ($favColor == "green") {
 $_SESSION["favcolor"] = "red";
 $_SESSION["favanimal"] = "dog";
 print "<p>Session variables are now red / dog.";
} else if ($favColor == "red") {
 session_unset();
 print "<p>All session variables are cleared.";
} else {
 $_SESSION["favcolor"] = "green";
 $_SESSION["favanimal"] = "cat";
 print "<p>Session variables are now green / cat.";
}
?>
</body>
</html>