<?php
include_once('db.php');
$servername = "easel2.fulgentcorp.com";
$dbUsername = "fgd806";
$dbPassword = "Evlv3h7MzBF30ay967IS";
$dbName = "fgd806";

$db = db_open("easel2.fulgentcorp.com", "fgd806", "fgd806", "Evlv3h7MzBF30ay967IS");

if(!$db) {
	die("Connection failed: ".mysqli_connect_error());
}