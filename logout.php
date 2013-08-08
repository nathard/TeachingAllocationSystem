<?php require_once('inc/dbconnect.php'); ?>
<html>
<body>
<?php
require_once('inc/top.php'); 
if (isset($_SESSION['user'])) 
{
   session_destroy();
   echo "<br> You have logged out successfully!";
} 
   echo "<br/><a href='UserLogin.php'>Login</a>";
?>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>