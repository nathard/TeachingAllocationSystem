<?php
require_once('inc/dbconnect.php');

//Lists units available to teacher
function ListUnits() {
	
	global $db;
	$sql = "SELECT * FROM units"; 	
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
		$output[] = '<tr><td><input type="radio" id="unitcode" name="unit" value="'.$unitcode.'"></td>';
		$output[] = '<td>'.$unitcode.'</td>';
		$output[] = '<td>'.$unitname.'</td>';
		$output[] = '<td>'.$details.'</td></tr>';
	}
	if(!$output)  {
		echo "Database unavailable";  
	  }
	else return join ('',$output);
}

function AddPreference() {
	global $db;
	//find last allocID for user 
	$query="SELECT ALLOCID, USERID FROM allocations WHERE ALLOCID = (SELECT MAX(ALLOCID) FROM allocations) AND userid = '".$_SESSION['userID']."'";
	$result = OCIParse($db, $query);
	if(!$result){
		echo "an error occured in parsing the sql string count";
		exit;
	}
	OCIExecute($result);
	//get rows
	$rows= OCIFetchStatement($result,$RowsResult);
	OCIExecute($result);
	OCIFetch($result);
	$allocID = OCIResult($result,"ALLOCID");
	
	/*echo '<script type="text/javascript">
window.alert("'.$rows.'")
</script>';*/
	if(($rows >= 4 OR $rows == 0) AND $_SESSION['user']){
		$query="SELECT MAX(ALLOCID) AS HIGH FROM allocations";
		$result = OCIParse($db,$query);
		if(!$result){
				echo "an error occured in parsing the sql string count";
				exit;
		}
		OCIExecute($result);
		OCIFetch($result);
		$allocID = intval(OCIResult($result,"HIGH"));
		
		//new allocation
		$allocID++;
		$query = "INSERT INTO allocations VALUES('".$allocID."',DATE '1998-12-25','".$_SESSION['userID']."','waiting')";
		$result = OCIParse($db,$query);
		if(!$result){
			echo "an error occured in parsing the sql string count";
			exit;
		}
		OCIExecute($result);
	}

	$unitcode = $_GET["unit"];
	$preference = $_GET["preference"];
	
	if(!$unitcode OR !$preference OR !$_SESSION['user']) {
		return;
		}
	else {
	
	$sql = "INSERT INTO preferences VALUES('".$allocID."','".$_SESSION['userID']."','$unitcode','$preference','NO','NO')"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n";
		exit; 
	  }
	OCIExecute($stmt);
	echo ("Preference Added<br />");
	}
}

function ListPrefs() {
	global $db;
	$sql = "SELECT ALLOCID, USERID, UNITCODE, PREFERENCE, CONFLICTS, APPROVED
FROM preferences 
WHERE allocid = (select max (allocid) from allocations sub where sub.userID = preferences.userid)
AND userID = '".$_SESSION['userID']."'";

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
		$output[] = '<tr><td>'.$unitcode.'</td>';
		$output[] = '<td>'.$preference.'</td>';
		$output[] = '<td>'.$conflicts.'</td>';
		$output[] = '<td>'.$approved.'</td>';
		$output[] = '<td><a href="editpref.php?unitcode='.$unitcode.'&allocid='.$allocid.'">Edit</a>'; 
		$output[] = '<a href="deletepref.php?unitcode='.$unitcode.'&allocid='.$allocid.'"> Delete</a></td></tr>';
	}
	if(!$output)  {
		echo "Database unavailable";
	  }
	else return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Teaching Preferences</h1>
		<br />
			<h4><b>Select Teaching Preferences:</b></h4>
			<form name='AddPreference' action='preferences.php' method='get'>
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th width = '1%'></th>
					<th width = '20%'>Unit Code</th>
					<th width = '20%'>Unit Name</th>
					<th width = '20%'>Details</th>
				</tr>
				
				<?php
					echo ListUnits();
				?>
				
			</table>
			<div align="center">
			<br />
				<input type="radio" id="pref" name="preference" value="preferred"> Preferred
				<input type="radio" id="pref" name="preference" value="nonpreferred"> Not Preferred
				<input type="radio" id="pref" name="preference" value="interested"> Interested
				<input type="radio" id="pref" name="preference" value="unable" checked="checked"> Unable
			</div>
			<input type='submit' value='Submit Preference' style="float: right;" />
			<?php
					AddPreference();
				?>
			</form>
			<hr />
			<h4><b>Current Preferences:</b></h4>
			<form name='SubmitPref' action='submitpref.php' method='get'>
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th>Unit Code</th>
					<th>Preference</th>
					<th>Conflicts</th>
					<th>Approved</th>
					<th>Action</th>
				</tr>
				
				<?php
					echo ListPrefs();
				?>
				
			</table>
			<br />
			<input type='submit' value='Submit Allocation' style="float: right;" />
			</form>
			
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>