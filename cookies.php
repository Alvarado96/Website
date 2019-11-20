<?php
include_once('db.php');
session_start();
if(!empty($_POST["login"])) {
	$name = $_POST["member_name"];
	$password = $_POST["member_password"];
	$db = db_open("easel2.fulgentcorp.com", "fgd806", "fgd806", "Evlv3h7MzBF30ay967IS");
	$sql = "SELECT * FROM Users WHERE username='$name' && password='$password'";
        if(!isset($_COOKIE["member_login"])) {
            $sql .= " AND username = '" . md5($_POST["member_password"]) . "'";
	}
    $result = mysqli_query($db, $sql);
	$user = mysqli_fetch_array($result);
	if($user) {
			$_SESSION["member_id"] = $user["member_id"];
			
			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
			}
	} else {
		$message = "Invalid Login";
	}
	
	$result = db_query($db, $sql);

	$num = db_num_rows($result);

	if($num == 1){
		$_SESSION['username'] = $name;
		header('location:main.php');
	}
	else{
		header('location:login.php');
	}
}
?>