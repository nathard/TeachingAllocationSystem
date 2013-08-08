<?php
  require_once('inc/dbconnect.php');
  
//used to retrive unit info and display it
function AddUnit() {
	global $db;
	$unitcode = $_POST["unitcode"];
	$unitname = $_POST["unitname"];
	$details = $_POST["details"];
	
	if(!$details) {
		return;
		}
	else {
	
	$sql = "INSERT INTO units VALUES('$unitcode','$unitname','$details')"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	echo ("Unit added successfully<br />");
	}
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Add Unit</h1>
		<br />
			<form name='AddUnit' action='addunit.php' method='post'>	
				<div>
				<label><strong>Unit Code:</strong></label><br />
				<input type="text" name="unitcode" id="unitcode" /></div><br />

				<div>
				<label><strong>Unit name:</strong></label><br />
				<input type="text" name="unitname" id="unitname"/></div><br />
				
				<div>
				<label><strong>Unit details:</strong></label><br />
				<textarea cols="25" rows="4" name="details"></textarea></div><br />
				
				<input type='submit' value='Add' />
			</form>
			<?php echo AddUnit(); ?>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html> 