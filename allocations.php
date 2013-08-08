<?php
require_once('inc/dbconnect.php');

//Lists units available to teacher
function ListAlloc() {
	
	global $db;
	$sql = "SELECT * FROM allocations"; 	
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
		$output[] = '<td>'.$status.'</td>';
		$output[] = '<td><input type="radio" name="allocid" value="'.$allocid.'"></td></tr>';
	}
	if(!$output)  {
		echo "Database unavailable";  
	  }
	else return join ('',$output);
}


function ViewPrefs() {
	
	global $db;
	$allocid = $_GET["allocid"];
	
	if(!$allocid) {
		return;
		}
	else {
			
			$sql = "SELECT * FROM preferences where allocid='".$allocid."'"; 	
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
				$output[] = '<td>'.$allocid.'</td>';
				$output[] = '<td>'.$unitcode.'</td>';
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
}

?>
<?php require_once('inc/top.php'); ?>
		<h1>Teaching Allocation</h1>
		<br />
			<h4><b>Select Allocation:</b></h4>
			<form name='ViewPref' action='allocations.php' method='get'>
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th width = '20%'>ID</th>
					<th width = '20%'>Date Submitted</th>
					<th width = '20%'>User ID</th>
					<th width = '20%'>Status</th>
					<th width = '1%'></th>
				</tr>
				<?php echo ListAlloc(); ?>
			</table>
			<br />
			<input type='submit' value='View Preferences' style="float: right;" />
			</form>
			<hr />
			<h4><b>Current Preferences</b></h4>
			<form name='SubmitPref' action='submitpref.php' method='get'>
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th>ID</th>
					<th>Unit Code</th>
					<th>Preference</th>
					<th>Conflicts</th>
					<th>Approved</th>
					<th>Action</th>
				</tr>
				<?php
					echo ViewPrefs();
				?>	
			</table>
			<br />
			<input type='submit' value='Finalise Allocation' style="float: right;" />
			</form>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>