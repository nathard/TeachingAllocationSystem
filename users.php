<?php
require_once('inc/dbconnect.php');

//Used to search and display users
function ListUsersAdm() {
	global $db;
	$id = $_GET["userid"];
	
	if(!$id) {
	//if not user display all
	$sql = "SELECT * FROM users"; }
	else {
	//else display users information
	$sql = "SELECT * FROM users WHERE userid like '%". $id ."%'"; }
		
			$stmt = OCIParse($db, $sql); 
				
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			OCIExecute($stmt);

			while(OCIFetch($stmt)) {
				$userid= OCIResult($stmt,"USERID");
				$username= OCIResult($stmt,"USERNAME");
				$fullname= OCIResult($stmt,"FULLNAME");
				$email= OCIResult($stmt,"EMAIL");
				$phone= OCIResult($stmt,"PHONE");
				$role= OCIResult($stmt,"ROLE");
				$status= OCIResult($stmt,"STATUS");
				
				//format output
				$output[] = '<tr><td>'.$userid.'</td>';
				$output[] = '<td>'.$username.'</td>';
				$output[] = '<td>'.$fullname.'</td>';
				$output[] = '<td>'.$email.'</td>';
				$output[] = '<td>'.$phone.'</td>';
				$output[] = '<td>'.$role.'</td>';
				$output[] = '<td>'.$status.'</td>';
				$output[] = '<td><a href="edituser.php?userid='.$userid.'">Edit |</a>'; 
				$output[] = '<a href="deleteuser.php?userid='.$userid.'" > Delete</a></td></tr>';
			}
			if(!$output)  {
				echo "There is no user to match your search condition.\n";  
			  }
			else return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>User Administration</h1>
		<br />
			<div>
			<form name='DisplayUnits' action='index.php' method='get' >
				<input type='text' name='unitcode' id='unitcode' />
				<input type='submit' value='search' />
			</form>
			<form name='AddUnit' action='adduser.php' style='float:right;' >
				<input type='submit' value='Add User'  />
			</form>
			</div> 
			<br />			
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th width = '5%'>User ID</th>
					<th width = '10%'>Username</th>
					<th width = '15%'>Full name</th>
					<th width = '15%'>Email address</th>
					<th width = '15%'>Phone number</th>
					<th width = '15%'>Role</th>
					<th width = '15%'>Status</th>
					<th width = '15%'>Action</th>
				</tr>
				<?php echo ListUsersAdm(); ?>
			</table>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>