<?php
require_once('inc/dbconnect.php');
  
  // Update user function
function UpdateUnit() {
	global $db;
	//store variables
	$unitcode= $_POST['unitcode'];
	$unitname= $_POST['unitname'];
	$details= $_POST['details'];
	
	$sql = "UPDATE units SET UNITCODE = '$unitcode', UNITNAME = '$unitname', DETAILS = '$details' WHERE unitcode = '$unitcode'";
			
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
			<?php echo UpdateUnit(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>