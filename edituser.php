<?php
  require_once('inc/dbconnect.php');
  
//used to retrive unit info and display it
function DisplayUser() {
	global $db;
	$id = $_GET["userid"];
	$sql = "SELECT * FROM users WHERE userid = '$id'";
		
	$stmt = OCIParse($db, $sql); 
		

	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);

	while(OCIFetch($stmt)) {

		$userid= OCIResult($stmt,"USERID");
		$username= OCIResult($stmt,"USERNAME");
		$password= OCIResult($stmt,"PASSWORD");
		$fullname= OCIResult($stmt,"FULLNAME");
		$email= OCIResult($stmt,"EMAIL");
		$phone= OCIResult($stmt,"PHONE");
		$role= OCIResult($stmt,"ROLE");
		$status= OCIResult($stmt,"STATUS");
		
		//format output
		$output[] = '<label><strong>User ID:</strong></label><br />';
		$output[] = '<input value= "'.$userid.'" type="text" name="userid" id="userid" /><br />';
		
		$output[] = '<label><strong>Username:</strong></label><br />';
		$output[] = '<input value= "'.$username.'" type="text" name="username" id="username"/><br />';
								
		$output[] = '<label><strong>Password:</strong></label><br />';
		$output[] = '<input value= "'.$password.'" type="password" name="password" id="password"/><br />';
		
		$output[] = '<label><strong>Full name:</strong></label><br />';
		$output[] = '<input value= "'.$fullname.'" type="text" name="fullname" id="fullname"/><br />';
		
		$output[] = '<label><strong>Email address:</strong></label><br />';
		$output[] = '<input value= "'.$email.'" type="text" name="email" id="email"/><br />';
		
		$output[] = '<label><strong>Phone number:</strong></label><br />';
		$output[] = '<input value= "'.$phone.'" type="text" name="phone" id="phone"/><br />';
		
		switch($role)
		{
			case "Teacher":
				$output[] = '<label><strong>Role:</strong></label><br />';
				$output[] = '<input type="radio" id="role" name="role" value="Teacher" checked="checked"> Teacher';
				$output[] =	'<input type="radio" id="role" name="role" value="Head of Institute"> Head of Institute';
				$output[] =	'<input type="radio" id="role" name="role" value="Teaching Administrator"> Teaching Administrator';
				$output[] =	'<input type="radio" id="role" name="role" value="System Administrator"> System Administrator <br />';
				break;
			case "Head of Institute":
				$output[] = '<label><strong>Role:</strong></label><br />';
				$output[] = '<input type="radio" id="role" name="role" value="Teacher" > Teacher';
				$output[] =	'<input type="radio" id="role" name="role" value="Head of Institute" checked="checked"> Head of Institute';
				$output[] =	'<input type="radio" id="role" name="role" value="Teaching Administrator"> Teaching Administrator';
				$output[] =	'<input type="radio" id="role" name="role" value="System Administrator"> System Administrator <br />';
				break;
			case "Teaching Administrator":
				$output[] = '<label><strong>Role:</strong></label><br />';
				$output[] = '<input type="radio" id="role" name="role" value="Teacher"> Teacher';
				$output[] =	'<input type="radio" id="role" name="role" value="Head of Institute"> Head of Institute';
				$output[] =	'<input type="radio" id="role" name="role" value="Teaching Administrator" checked="checked"> Teaching Administrator';
				$output[] =	'<input type="radio" id="role" name="role" value="System Administrator"> System Administrator <br />';
				break;
			case "System Administrator":
				$output[] = '<label><strong>Role:</strong></label><br />';
				$output[] = '<input type="radio" id="role" name="role" value="Teacher"> Teacher';
				$output[] =	'<input type="radio" id="role" name="role" value="Head of Institute"> Head of Institute';
				$output[] =	'<input type="radio" id="role" name="role" value="Teaching Administrator"> Teaching Administrator';
				$output[] =	'<input type="radio" id="role" name="role" value="System Administrator" checked="checked"> System Administrator <br />';
				break;
		}
		
		if ($status === 'enabled') 
		{
			$output[] = '<label><strong>Status:</strong></label><br />';
			$output[] = '<input type="radio" id="status" name="status" value="enabled" checked="checked"> Enabled';
			$output[] =	'<input type="radio" id="status" name="status" value="suspended"> Suspended<br />';
		} else
		{
			$output[] = '<label><strong>Status:</strong></label><br />';
			$output[] = '<input type="radio" id="status" name="status" value="enabled"> Enabled';
			$output[] =	'<input type="radio" id="status" name="status" value="suspended" checked="checked"> Suspended<br />';
		}	
	}
	return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Edit User</h1>
		<br />
			<form name='UpdateUser' action='updateuser.php' method='post'>	
				<?php echo DisplayUser(); ?>
				<input type='submit' value='Update' />                 
			</form>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html> 