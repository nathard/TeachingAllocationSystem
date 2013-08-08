<?php
require_once('inc/dbconnect.php');

//Lists units available to teacher
function GenReport() {
	
	global $db;
	$id = $_POST["userid"];
	
	// get most recent allocation
	$sql = "select * from allocations where allocid in (select max(allocid) from allocations where userid = '$id')"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	while(OCIFetch($stmt)) {

		$allocid= OCIResult($stmt,"ALLOCID");
		$allocdate= OCIResult($stmt,"ALLOCDATE");
		$userid= OCIResult($stmt,"USERID");
		$status= OCIResult($stmt,"STATUS");
		
		//format output
		$output[] = '<tr><td>'.$allocid.'</td>';
		$output[] = '<td>'.$allocdate.'</td>';
		$output[] = '<td>'.$userid.'</td>';
		$output[] = '<td>'.$status.'</td></tr>';
	}

	if(!$output)  {
		echo "Database unavailable";  
	  }
	else return join ('',$output);
}

function GenPrefs() {
	
	global $db;
	$id = $_POST["userid"];
	
	// get most recent allocation
	$sql = "select * from preferences where allocid in (select max(allocid) from preferences where userid = '$id')"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	while(OCIFetch($stmt)) {

		$unitcode= OCIResult($stmt,"UNITCODE");
		$preference= OCIResult($stmt,"PREFERENCE");
		$conflicts= OCIResult($stmt,"CONFLICTS");
		$approved= OCIResult($stmt,"APPROVED");
		//format output
		$output[] = '<tr><td>'.$unitcode.'</td>';
		$output[] = '<td>'.$preference.'</td>';
		$output[] = '<td>'.$conflicts.'</td>';
		$output[] = '<td>'.$approved.'</td></tr>';
	}

	if(!$output)  {
		echo "Database unavailable";  
	  }
	else return join ('',$output);
}

?>
<?php require_once('inc/top.php'); ?>
	<?php
			echo "<h1>Allocation Report for user ID: " .$_POST["userid"]. "</h1>";
				?>
		<br />
			<h3>Allocation:</h3>
			<table border='1' width = '100%'>
				<tr>
					<th width = '20%'>ID</th>
					<th width = '20%'>Date Submitted</th>
					<th width = '20%'>User ID</th>
					<th width = '20%'>Status</th>
				</tr>
				<?php
					echo GenReport();
				?>	
			</table>
			<br />
			<h3>Preferences:</h3>
			<table border='1' width = '100%'>
				<tr>
					<th>Unit Code</th>
					<th>Preference</th>
					<th>Conflicts</th>
					<th>Approved</th>
				</tr>
				<?php
					echo GenPrefs();
				?>	
			</table>
			<br />
			<input type='submit' value='Send Report' style="float: right;" />
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>