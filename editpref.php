<?php
  require_once('inc/dbconnect.php');
  
//used to retrive unit info and display it
function DisplayPref() {
	global $db;
	$uid = $_GET["unitcode"];
	$aid = $_GET["allocid"];
	$sql = "SELECT * FROM preferences WHERE allocid = '$aid' and unitcode = '$uid'";
		
	$stmt = OCIParse($db, $sql); 
		

	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);

	while(OCIFetch($stmt)) {

		$allocid= OCIResult($stmt,"ALLOCID");
		$unitcode= OCIResult($stmt,"UNITCODE");
		$preference= OCIResult($stmt,"PREFERENCE");
		$conflicts= OCIResult($stmt,"CONFLICTS");
		$approved= OCIResult($stmt,"APPROVED");
		
		//format output
		$output[] = '<label><strong>Allocation ID:</strong></label><br />';
		$output[] = '<input value= "'.$allocid.'" type="text" name="allocid" id="allocid" readonly /><br />';
		
		$output[] = '<label><strong>Unit Code:</strong></label><br />';
		$output[] = '<input value= "'.$unitcode.'" type="text" name="unitcode" id="unitcode" readonly/><br />';

		$output[] = '<label><strong>Conflicts:</strong></label><br />';
		$output[] = '<input value= "'.$conflicts.'" type="text" name="conflicts" id="conflicts" readonly/><br />';
		
		$output[] = '<label><strong>Approved:</strong></label><br />';
		$output[] = '<input value= "'.$approved.'" type="text" name="approved" id="approved" readonly/><br /><br />';
		
		switch($preference)
		{
			case "preferred":
				$output[] = '<input type="radio" id="pref" name="pref" value="preferred" checked="checked"> Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="nonpreferred"> Not Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="interested"> Interested';
				$output[] =	'<input type="radio" id="pref" name="pref" value="unable"> Unable';
				break;
			case "nonpreferred":
				$output[] = '<input type="radio" id="pref" name="pref" value="preferred"> Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="nonpreferred" checked="checked"> Not Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="interested"> Interested';
				$output[] =	'<input type="radio" id="pref" name="pref" value="unable"> Unable';
				break;
			case "interested":
				$output[] = '<input type="radio" id="pref" name="pref" value="preferred"> Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="nonpreferred"> Not Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="interested" checked="checked"> Interested';
				$output[] =	'<input type="radio" id="pref" name="pref" value="unable"> Unable';
				break;
			case "unable":
				$output[] = '<input type="radio" id="pref" name="pref" value="preferred"> Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="nonpreferred"> Not Preferred';
				$output[] =	'<input type="radio" id="pref" name="pref" value="interested"> Interested';
				$output[] =	'<input type="radio" id="pref" name="pref" value="unable" checked="checked"> Unable';
				break;
		}
		
		
			
	}
	return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Edit Preference</h1>
		<br />
			<form name='UpdateUser' action='updatepref.php' method='post'>	
				<?php echo DisplayPref(); ?>
				<br /><br />
				<input type='submit' value='Update' />                 
			</form>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html> 