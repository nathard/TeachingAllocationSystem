<?php
  
  // Update user function
function UpdateUser() {
	echo "not implemented.";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TAS </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">Teaching Allocation System</a></h1>
			
		</div>
	</div>
	<div id="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="preferences.php">Preferences</a></li>
			<li><a href="allocations.php">Allocations</a></li>
			<li><a href="reports.php">Reports</a></li>
			<li><a href="units.php">Units</a></li>
			<li><a href="users.php">Users</a></li>
		</ul>
	</div>

	<div id="three-columns">
		<div class="content">
			<h3>
			<?php echo UpdateUser(); ?>
			</h3>
		</div>
	</div>
</div>

</div>
</body>
</html>        
       
        	
        
