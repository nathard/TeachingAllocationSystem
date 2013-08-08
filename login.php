<?php 
	require_once('inc/dbconnect.php');
	$username = $_POST["username"]; //Storing username in $username variable.
	$password = $_POST["password"]; //Storing password in $password variable.

	$query="SELECT * FROM users WHERE USERNAME = '$username' AND PASSWORD='$password'";
	$result = OCIParse($db,$query);
	if(!$result){
		echo "an error occured in parsing the sql string count";
		exit;
	}
	
	OCIExecute($result);
	$rows= OCIFetchStatement($result,$RowsResult);

	if($rows ==1){
	OCIExecute($result);
	OCIFetch($result);
	$_SESSION['userID'] = OCIResult($result,"USERID");
	$_SESSION['user'] = OCIResult($result,"USERNAME");
	$_SESSION['pass'] = OCIResult($result,"PASSWORD");
	$_SESSION['name'] = OCIResult($result,"FULLNAME");
	$_SESSION['email'] = OCIResult($result,"EMAIL");
	$_SESSION['phone'] = OCIResult($result,"PHONE");
	$_SESSION['role'] = OCIResult($result,"ROLE");
	$_SESSION['status'] = OCIResult($result,"STATUS");
	OCILogOff ($db);
	}
	// It is the page where you want to redirect user after login.
	if (isset($_SESSION['user']))
	{
		header('Location:preferences.php');
	}
	else
	{
		echo "Your username/password is incorrect. Please try again"; 
		echo "<br /><a href='UserLogin.php'>Login</a>";
	}
?>