<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Assignment 5</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="layout.css">

<script src="valid.js" type="text/javascript"></script>

</head>
<?php
if(isset($_COOKIE['password'])) {
	$password = $_COOKIE['password'];
	$key = md5('key');
	$decPassword = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($password), MCRYPT_MODE_ECB));
}
?>
<h1>Login</h1>
<form action="validation.php" method="post">

<div>
  <label>Username:	<input class="o1" type="text" name="uid" placeholder="Username" value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>">
  
  <label>Password:	<input class="o1" type="password" name="pwd" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) echo $decPassword; ?>">
  <br/>
  
  
  <label>Remember Me: <input type="checkbox" name="remember_me">
  <div/>
  
  <button type = "submit" name="login-submit">Login</button>
  
</div>
  
  
</form>
</style>
</html>