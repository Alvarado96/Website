<?php
if (isset($_POST['signup-submit'])) {
	require 'dbh.php';
	include_once('db.php');
	$name = htmlentities($_POST['name']);
	//escape single quotes
	$name = preg_replace("/[']/", "\'", $name);
	$name = preg_replace("/[$,-;]/", "", $name);
	$username = htmlentities($_POST['uid']);
	$username = preg_replace("/[']/", "\'", $username); //escape single quotes for username
	$username = preg_replace("/[$,-;]/", "", $username);
	//********
	$password = htmlentities($_POST['pwd']);
	//$password = preg_replace("/[']/", "\'", $password); //escape single quotes for password
	//encrypt password
	//$encPassword = hash('sha512', $password);
	$key = md5('key');
	$encPassword = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $password, MCRYPT_MODE_ECB)));
	$college = $_POST['College'];
	$admin = $_POST['isAdmin'];
	$year = htmlentities($_POST['year']);
	$month = $_POST['month'];
	$day = $_POST['day'];
	$date = $year."-".$month."-".$day;
	if($admin != 1) $admin = 0;
	
	list($fname, $lname) = explode(" ", $name);
	//$name_array = split_name($name);
	$first = $fname;//$name_array["first_name"];
	$last = $lname;//$name_array["last_name"];
	
	if(empty($username) || empty($password)){
		//code ..
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&password=".$password);
		//exit();
	}
	if(strlen($password) < 4){
		header("Location: ../signup.php?error=passwordlength");
	}
	else if (!preg_match("/^[a-zA-z]*$/", $username)) {
		header("Location: ../signup.php?error=invaliduid&name=".$username);
		//exit();
	}
	
	else {
		
		$sql = "SELECT * FROM Users WHERE username=?;";
		$stmt = mysqli_stmt_init($db);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../signup.php?error=sqlerror");
		}
		
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt); //TODO
			if($resultCheck > 0) {
				header("Location: ../signup.php?error=usertaken");
			}
			else {
				
				$sql = "INSERT INTO Users (First, Last, IsAdmin, password, username, college) VALUES (?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($db);
				if (!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../signup.php?error=sqlerror");
				}
				else {
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					
					$sql="INSERT INTO Users(First, Last, IsAdmin, password, username, college, date) VALUES('$fname', '$lname', '$admin', '$encPassword', '$username', '$college', '$date')";
					$result=db_query($db, $sql);
					
					header("Location: ../login.php");
					exit();
					
				}
			}
		}
		
		
	}
	mysqli_stmt_close($stmt);
	mysqli_close($db);
	
}
else {
	header("Location: ../signup.php");
}

function split_name($name) {
    $parts = array();

    while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.$string.'#', '', $name ) );
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

    return $name;
}