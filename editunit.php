<?php
  require_once('inc/dbconnect.php');
  
//used to retrive unit info and display it
function DisplayUnit() {
	global $db;
	$id = $_GET["unitcode"];
	$sql = "SELECT * FROM units WHERE unitcode = '$id'";
		
	$stmt = OCIParse($db, $sql); 
		

	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);

	while(OCIFetch($stmt)) {

		$unitcode= OCIResult($stmt,"UNITCODE");
		$unitname= OCIResult($stmt,"UNITNAME");
		$details= OCIResult($stmt,"DETAILS");
		
		//format output
		$output[] = '<div>';
		$output[] = '<label><strong>Unit Code:</strong></label><br />';
		$output[] = '<input value= "'.$unitcode.'" type="text" name="unitcode" id="unitcode" /></div><br />';
		
		$output[] = '<div>';
		$output[] = '<label><strong>Unit name:</strong></label><br />';
		$output[] = '<input value= "'.$unitname.'" type="text" name="unitname" id="unitname"/></div><br />';
								
		$output[] = '<div>';
		$output[] = '<label><strong>Unit details:</strong></label><br />';
		$output[] = '<textarea cols="25" rows="4" name="details">'.$details.'</textarea></div><br />';
		
	}
	return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Edit Unit</h1>
		<br />
			<form name='UpdateUnit' action='updateunit.php' method='post'>	
				<?php echo DisplayUnit(); ?>
				<input type='submit' value='Update' />                 
			</form>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html> 