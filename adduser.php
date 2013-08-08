<?php
  require_once('inc/dbconnect.php');
  
//used to retrive unit info and display it
function AddUser() {
	global $db;
	$userid= $_POST['userid'];
	$username= $_POST['username'];
	$password= $_POST['password'];
	$fullname= $_POST['fullname'];
	$email= $_POST['email'];
	$phone= $_POST['phone'];
	$role= $_POST['role'];
	$status= $_POST['status'];
	
	if(!$status) {
		return;
		}
	else {
	
	$sql = "INSERT INTO users VALUES('$userid','$username','$password','$fullname','$email','$phone','$role','$status')"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	echo ("User added successfully<br />");
	}
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Add User</h1>
		<br />
			<form name='AddUser' action='adduser.php' method='post'>	
				<label><strong>User ID:</strong></label><br />
				<input type="text" name="userid" id="userid" /><br />
				
				<label><strong>Username:</strong></label><br />
				<input type="text" name="username" id="username"/><br />
										
				<label><strong>Password:</strong></label><br />
				<input type="password" name="password" id="password"/><br />
				
				<label><strong>Full name:</strong></label><br />
				<input type="text" name="fullname" id="fullname"/><br />
				
				<label><strong>Email address:</strong></label><br />
				<input type="text" name="email" id="email"/><br />
				
				<label><strong>Phone number:</strong></label><br />
				<input type="text" name="phone" id="phone"/><br />
		
				<label><strong>Role:</strong></label><br />
				<input type="radio" id="role" name="role" value="Teacher" checked="checked"> Teacher
				<input type="radio" id="role" name="role" value="Head of Institute"> Head of Institute
				<input type="radio" id="role" name="role" value="Teaching Administrator"> Teaching Administrator
				<input type="radio" id="role" name="role" value="System Administrator"> System Administrator <br />
				
				<label><strong>Status:</strong></label><br />
				<input type="radio" id="status" name="status" value="enabled" checked="checked"> Enabled
				<input type="radio" id="status" name="status" value="suspended"> Suspended<br />

				<input type='submit' value='Add' />
			</form>
			<?php echo AddUser(); ?>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html> 