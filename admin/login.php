<?php
	$filepath = realpath(dirname(__FILE__));

	include_once $filepath.'/../lib/Session.php';
	require '../classess/Admin.php';

	Session :: init();
	
	$admin 	= new Admin();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username 	= $_POST['username'];
		$password 	= md5($_POST['password']);
		
		$is_logged =  $admin->login($username, $password);
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php
				if(isset($is_logged))
				{
					echo "<span style='color: red; font-size: 20px;'>$is_logged</span>";
				}
			
			?>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>