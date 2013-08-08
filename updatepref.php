<?php
require_once('inc/dbconnect.php');
  
  // Update user function
function UpdatePref() {
	global $db;
	//store variables
	$allocid= $_POST['allocid'];
	$unitcode= $_POST['unitcode'];
	$preference= $_POST['pref'];

	$sql = "UPDATE preferences SET preference = '$preference' WHERE allocid = '$allocid' and unitcode = '$unitcode'";
			
	$stmt = OCIParse($db, $sql); 

	if(!$stmt)  { 
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	
	echo ("Preference Update Successful<br />");
	
}

?>
<?php require_once('inc/top.php'); ?>
			<h3>
			<?php echo UpdatePref(); ?>
			</h3>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>