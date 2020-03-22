<?php 
	require "inc/header.php"; 

	if(isset($_GET['product_id']))
	{
		$product_id 	= $_GET['product_id'];
	}
	$login 				= Session::get('login');
	$user_id			= Session :: get('id');

	$product_details 	= $product -> get_product_details($product_id);
	$list 				= $category -> get_all_category();

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cart']))
	{
		$quantity 		= 	$_POST['quantity'];
		$is_inserted 	=   $cart -> insert($quantity, $product_id);
	}

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare']))
	{
		$is_Inserted 	= $compare -> insert($product_id, $user_id);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['whislist']))
	{
		$product_id 		= $_POST['product_id'];
		$isWhislistInserted = $whislist -> insert($product_id, $user_id);
	}

?>

<style>
	.myButton
	{
		width: 100px;
		margin-right: 30px;
		float: left;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">		
				<?php
					
					if($product_details)
					{
						while($data = $product_details -> fetch_assoc())
						{
					?>
						<div class="grid images_3_of_2">
							<img src="admin/<?= $data['image']; ?>" alt="" />
						</div>
						
				<div class="desc span_3_of_2">
					<h2><?= $data['name']; ?></h2>
					<p><?= $data['body']; ?></p>					
					<div class="price">
						<p>Price: <span>$<?= $data['price']; ?></span></p>
						<p>Category: <span><?= $data['name']; ?></span></p>
						<p>Brand:<span><?= $data['name']; ?></span></p>
					</div>

				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="add_cart" value="Buy Now"/>
					</form>				
				</div>
				<span style="color: red; font-size: 20px;margin:0px;">
					<?php
						if(isset($is_inserted))
						{
							echo $is_inserted;
						}
					?>
				</span>
				<?php
						if(isset($is_Inserted))
						{
							echo "<span style='color : green; font-size: 18px;'>$is_Inserted</span>";
						}
						if(isset($isWhislistInserted))
						{
							echo "<span style='color : green; font-size: 18px;'>$isWhislistInserted</span>";
						}
					?>
				<?php

					
					if($login == true)
					{
				?>
					<div class="add-cart">
						<div class="myButton">
							<form action="" method="post">
								<input type="hidden" class="buyfield" name="product_id" value="<?= $data['id'];?>"/>
								<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
							</form>	
						</div>	
						<div class="myButton">
							<form action="" method="post">
								<input type="hidden" class="buyfield" name="product_id" value="<?= $data['id'];?>"/>
								<input type="submit" class="buysubmit" name="whislist" value="Add to List"/>
							</form>	
						</div>
								
					</div>
				<?php
					}
				?>
				
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
			<?php
					}
				}
			?>
		</div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php

						if($list)
						{
							while($result = $list->fetch_assoc())
							{
					?>
								<li><a href="productbycat.php?category_id=<?= $result['id'];?>"><?= $result['name']; ?></a></li>
					<?php
							}
						}		
					?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
</div>
<?php require 'inc/footer.php'; ?>