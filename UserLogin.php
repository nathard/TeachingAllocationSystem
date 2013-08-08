<?php
require_once('inc/dbconnect.php');
$username = $_SESSION['username'];
require_once('inc/top.php'); ?>
		<h1>Login to TAS</h1>
		<br />
			 <form name="login" action="login.php" method="post">          
				<div>
				<label><strong>Username:</strong></label>
				<br />
				<input type="text" name="username" />
				</div>  
				<br />
				<div>
				<label><strong>Password:</strong></label>
				<br />
				<input type="password" name="password"/>
				</div>                     
				<br />
				<div>
					<div>
					<input type="checkbox" name="terms" />
					Remember me
					</div>
				</div> 
				<br />
				<div>
				<input type="submit" value="Login" />
				</div>   
			  </form>     
		</div>  
	</div>	
</div>
<?php require_once('inc/footer.php'); ?>
</body>
</html>