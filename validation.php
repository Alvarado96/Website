<?php
include_once('db.php');

session_start();

$db = db_open("easel2.fulgentcorp.com", "fgd806", "fgd806", "Evlv3h7MzBF30ay967IS");

$name = htmlentities($_POST['uid']);
$password = htmlentities($_POST['pwd']);
//******

$key = md5('key');
$encPassword = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
$sql = "SELECT * FROM Users WHERE username='$name' && password='$encPassword'";

$result = db_query($db, $sql);

$num = db_num_rows($result);

//set the cookie
if(isset($_POST['remember_me'])){
	$cookie_name = "username";
	$cookie_password = "password";
	setcookie($cookie_name, $name, time() + (86400 * 7), "/");
	setcookie($cookie_password, $encPassword, time() + (86400 * 7));
}

if($num == 1){
	$_SESSION['username'] = $name;
	header('location:UTSABookClub.php');
}
else{
	header('location:login.php');
}

?>