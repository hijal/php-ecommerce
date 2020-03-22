
<?php
	header("Cache-Control: no-cache, must-revalidate");
  	header("Pragma: no-cache"); 
  	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  	header("Cache-Control: max-age=2592000");

 	include 'lib/Session.php';
	Session :: init();


	include 'lib/Database.php';
	include 'helpers/Format.php';

	spl_autoload_register(function ($class_name) {
		include "classess/".$class_name.'.php';
	});
	
	$db 		= new Database();
	$format 	= new Format();
	$cart 		= new Cart();
	$product 	= new Product();
	$category 	= new Category();
	$user 		= new User();
	$compare 	= new Compare();
	$whislist 	= new Whislist();

	$login 		= Session::get('login');
	$user_id 	= Session::get('id');

	

	if(isset($_GET['user_id']))
	{
		$delete_cart 	= $cart->delete_cart_data();
		Session :: destroy();
	}
	
	if(isset($_GET['user_id']))
	{
		$is_deleted = $compare->delete($user_id);
		Session :: destroy();
	}

	$is_order_empty 	= $cart -> isEmpty($user_id);
	$is_empty 			= $cart -> is_empty();
	$is_compare_empty 	= $compare->is_compare_empty($user_id);
	$is_whislist_empty 	= $whislist->is_whislist_empty($user_id);
?>


<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
								  <?php
									 if($is_empty)
									 {
										echo '$ '.Session::get('sum');
									 }
									 else
									 {
										 echo "(Empty)";
									 }
								  ?>
								</span>
							</a>
						</div>
			      </div>
		   <?php
				 if($login == false)
				 {
					 ?>
					 	<div class="login"><a href="login.php">Login</a></div>
					 <?php
				 }
				 else
				 {
					 ?>
					 <div class="login"><a href="?user_id=<?= $user_id; ?>">Logout</a></div>
					 <?php
				 }  
		   ?>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php 
		if($is_empty)
		{
			?>
			<li><a href="cart.php">Cart</a></li>
			<li><a href="payment.php">Payment</a></li>
			<?php
		} 
	  ?>
	   <?php 
		if($is_order_empty)
		{
			?>
			<li><a href="orders.php">Order</a></li>
			<?php
		} 
	  ?>
	  
	  <li><a href="contact.php">Contact</a> </li>
	  <?php 
		if($login)
		{
			?>
			<li><a href="profile.php">Profile</a> </li>
			<?php
		} 
	  ?>
	  <?php
		
			if($is_compare_empty)
			{
		?>
			<li><a href="compare.php">Compare</a></li>
		<?php
			} 
	  ?>
	   <?php

			if($is_whislist_empty)
			{
		?>
			<li><a href="whislist.php">WishList</a></li>
		<?php
			} 
	  ?>
	  <div class="clear"></div>
	</ul>
</div>