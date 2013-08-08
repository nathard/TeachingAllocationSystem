<?php
  require_once('inc/dbconnect.php');
  
  //Used to delete a unit from the database
  function DeleteUser() {
			global $db;
			$userid = $_GET['userid'];
			$valid = true;
			
			if($valid)
			{
				$sql1 = "SELECT * FROM preferences WHERE userid = '$userid'";
				$stmt1 = OCIParse($db, $sql1); 
				
  
				if(!$stmt1)  {
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt1);
				
				$testunit = " ";
				while(OCIFetch($stmt1)) {

					$testunit= OCIResult($stmt1,"USERID");
				}
				
				if ($testunit == $userid) {
					echo ("Preferences exist for this user<br />");
					$valid = false;
				}
			}
			
			//If no orders found delete user
			if ($valid) {
				$sql = "DELETE FROM users WHERE userid = '$userid'";
							
				$stmt = OCIParse($db, $sql); 
	  
				if(!$stmt)  { 
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt);
				
				echo ("User deleted Successfully<br /> ");
				
			}
		}

?>
<?php require_once('inc/top.php'); ?>
			<h3>
			<?php echo DeleteUser(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>