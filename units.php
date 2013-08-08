<?php
require_once('inc/dbconnect.php');

//Used to search and display users
function ListUnitsAdm() {
	global $db;
	$id = $_GET["unitcode"];
	
	if(!$id) {
	//if not user display all
	$sql = "SELECT * FROM units"; }
	else {
	//else display users information
	$sql = "SELECT * FROM units 
			WHERE unitcode like '%". $id ."%'
			OR unitcode like upper('%". $id ."%')"; }
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
				$output[] = '<tr><td>'.$unitcode.'</td>';
				$output[] = '<td>'.$unitname.'</td>';
				$output[] = '<td>'.$details.'</td>';
				if($_SESSION['role'] == 'Teaching Administrator')
				{
					$output[] = '<td><a href="editunit.php?unitcode='.$unitcode.'">Edit |</a>'; 
					$output[] = '<a href="deleteunit.php?unitcode='.$unitcode.'" > Delete</a></td></tr>';
				}
			}
			if(!$output)  {
				echo "There is no unit match your search condition.\n";  
			  }
			else return join ('',$output);
}
?>
<?php require_once('inc/top.php'); ?>
		<h1>Unit Administration</h1>
		<br />
			<div>
			<form name='DisplayUnits' action='units.php' method='get' >
				<input type='text' name='unitcode' id='unitcode' />
				<input type='submit' value='search' />
			</form>
			<?php if($_SESSION['role'] == 'Teaching Administrator')
			{
				echo "<form name='AddUnit' action='addunit.php' style='float:right;' >
				<input type='submit' value='Add Unit'  /></form>";
			}
			?>
			</div> 
			<br />			
			<table border='1' width = '100%'>
				<tr class='cart_title'>
					<th width = '15%'>Unit Code</th>
					<th width = '15%'>Unit Name</th>
					<th width = '20%'>Unit Details</th>
					<?php if($_SESSION['role'] == 'Teaching Administrator')
						{ echo "<th width = '5%'>Action</th>"; }
					?>
				</tr>
				<?php echo ListUnitsAdm(); ?>
			</table>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>