<?php
  require_once('inc/dbconnect.php');
  //Used to delete a unit from the database
  function DeleteUnit() {
			global $db;
			$unitcode = $_GET['unitcode'];
			$valid = true;
			
			if($valid)
			{
				$sql1 = "SELECT * FROM preferences WHERE unitcode = '$unitcode'";
				$stmt1 = OCIParse($db, $sql1); 
				
  
				if(!$stmt1)  {
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt1);
				
				$testunit = " ";
				while(OCIFetch($stmt1)) {

					$testunit= OCIResult($stmt1,"UNITCODE");
				}
				
				if ($testunit == $unitcode) {
					echo ("Preferences exist for this unit<br />");
					echo('<a href="users.php?">Click here to return</a>');
					$valid = false;
				}
			}
			
			//If no orders found delete user
			if ($valid) {
				$sql = "DELETE FROM units WHERE unitcode = '$unitcode'";
							
				$stmt = OCIParse($db, $sql); 
	  
				if(!$stmt)  { 
					echo "An error occurred in parsing the sql string.\n"; 
					exit; 
				  }
				OCIExecute($stmt);
				
				echo ("Unit deleted Successfully<br /> ");
				
			}
		}

?>
<?php require_once('inc/top.php'); ?>
			<h3>
			<?php echo DeleteUnit(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>