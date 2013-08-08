<?php
require_once('inc/dbconnect.php');

//Lists units available to teacher
function ListUsers() {
	
	global $db;
	$sql = "SELECT * FROM users where role = 'Teacher'"; 	
	$stmt = OCIParse($db, $sql); 
		
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt);
	
	while(OCIFetch($stmt)) {

		$userid= OCIResult($stmt,"USERID");
		$fullname= OCIResult($stmt,"FULLNAME");
		$email= OCIResult($stmt,"EMAIL");
		
		//format output
		$output[] = '<tr><td><input type="radio" id="userid" name="userid" value="'.$userid.'"></td>';
		$output[] = '<td>'.$userid.'</td>';
		$output[] = '<td>'.$fullname.'</td>';
		$output[] = '<td>'.$email.'</td></tr>';
	}
	if(!$output)  {
		echo "Database unavailable";  
	  }
	else return join ('',$output);
}


function GenStats(){

	global $db; 	
	$stmt1 = OCIParse($db, "SELECT * FROM allocations"); 
	$stmt2 = OCIParse($db, "SELECT * FROM allocations where status = 'waiting'");
	$stmt3 = OCIParse($db, "select * FROM allocations where allocdate between to_date('1-JAN-13') and to_date('1-JAN-14')"); 
	
	OCIExecute($stmt1);
	$total1 = oci_fetch_all($stmt1, $res);
	OCIExecute($stmt2);
	$total2 = oci_fetch_all($stmt2, $res);
	OCIExecute($stmt3);
	$total3 = oci_fetch_all($stmt3, $res);
	
	$output[] = '<tr><td>Total number of allocations in the System</td>';
	$output[] = '<td>'.$total1.'</td></tr>';
	$output[] = '<tr><td>Total number of allocations this submission cycle</td>';
	$output[] = '<td>'.$total3.'</td></tr>';
	$output[] = '<tr><td>Total number of allocations waiting for finalising</td>';
	$output[] = '<td>'.$total3.'</td></tr>';
	return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Allocation Reports</h1>
		<br />
			<h4><b>Select User:</b></h4>
			<form name='GenReport' action='genreport.php' method='post'>
			<table border='1' width = '100%'>
				<tr>
					<th width = '1%'></th>
					<th width = '20%'>User ID</th>
					<th width = '20%'>Full name</th>
					<th width = '20%'>Email</th>
				</tr>
				<?php echo ListUsers(); ?>
			</table>
			<br />
			<input type='submit' value='Generate Report' style="float: right;" />
			</form>
			<br />
			<br />
			<h4 align='center'><u>Allocation Statistics</u></h4>
			<table border='1' align='center' width = '50%'>
				<?php echo GenStats(); ?>
			</table>
			<br />
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>