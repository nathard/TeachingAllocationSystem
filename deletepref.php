<?php
  require_once('inc/dbconnect.php');
  
  //Used to delete a unit from the database
  function DeletePref() {
		global $db;
		$allocid = $_GET['allocid'];
		$unitcode = $_GET['unitcode'];
		
		$sql = "DELETE FROM preferences WHERE allocid = '$allocid' and unitcode = '$unitcode'";
					
		$stmt = OCIParse($db, $sql); 

		if(!$stmt)  { 
			echo "An error occurred in parsing the sql string.\n"; 
			exit; 
		  }
		OCIExecute($stmt);
		
		echo ("Preference deleted successfully<br /> ");
				
			
		}

?>
<?php require_once('inc/top.php'); ?>
			<h3>
			<?php echo DeletePref(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>