<?php
require_once('inc/dbconnect.php');
  
  // Update user function
function UpdateUser() {
	global $db;
	//store variables
	$userid= $_POST['userid'];
	$username= $_POST['username'];
	$password= $_POST['password'];
	$fullname= $_POST['fullname'];
	$email= $_POST['email'];
	$phone= $_POST['phone'];
	$role= $_POST['role'];
	$status= $_POST['status'];
	
	$sql = "UPDATE users SET USERNAME = '$username', PASSWORD = '$password' , FULLNAME = '$fullname', EMAIL = '$email', PHONE = '$phone', ROLE = '$role', STATUS = '$status' WHERE userid = '$userid'";
			
	$stmt = OCIParse($db, $sql); 

	if(!$stmt)  { 
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	
	echo ("Update Successful<br />");

}

?>
<?php require_once('inc/top.php'); ?>
			<h3>
			<?php echo UpdateUser(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>