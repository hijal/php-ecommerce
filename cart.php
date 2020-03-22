<?php 
	require "inc/header.php"; 


	$cart_list 		= $cart -> get_cart_list();
	$is_empty 		= $cart -> is_empty();

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity_update']))
	{
		$cart_id 			= $_POST['cart_id'];
		$quantity 			= $_POST['quantity'];
		$is_updated 		=  $cart -> update($cart_id, $quantity);

		if($quantity <= 0)
		{
			$delCart 	= $cart -> delete($cart_id);
		}
	}

	if(isset($_GET['cart_id']))
	{
		$cart_id 		= $_GET['cart_id'];
		$is_deleted 	= $cart -> delete($cart_id);
	}

	if(!isset($_GET['id']))
	{
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}


?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="20%">SL.</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								if($cart_list)
								{
									$i 		= 0;
									$sum 	= 0;
									while($data = $cart_list->fetch_assoc())
									{
										$i++;
							?>
							<tr>
								<td><?= $i?></td>
								<td><?= $data['product_name']; ?></td>
								<td><img src="admin/<?= $data['image']; ?>" alt=""/></td>
								<td><?= $data['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_id" value="<?= $data['id']; ?>"/>	
										<input type="number" name="quantity" value="<?= $data['quantity']; ?>"/>
										<input type="submit" name="quantity_update" value="Update"/>
									</form>
								</td>
								<td><?php echo ($total =  $data['price'] * $data['quantity']); ?></td>
								<td><a onclick="return confirm('Are you Confirm To Delete?')" href="?cart_id=<?= $data['id']; ?>">X</a></td>
							</tr>
							<?php
								$sum += $total;
								Session :: set('sum', $sum);
									}
								}
							?>
							
						</table>
						<?php
						if($is_empty)
						{
							?>
							<table style="float:right;text-align:left;" width="50%">
										<tr>
											<th>Sub Total : </th>
											<td><?= $sum; ?> TK</td>
										</tr>
										<tr>
											<th>VAT : </th>
											<td>10%</td>
										</tr>
										<tr>
											<th>Grand Total :</th>
											<td>
												<?php
													$vat 			= $sum * (10 / 100);
													$grand_total 	= $sum + $vat;
													echo $grand_total. " TK";
												
												?>
											</td>
										</tr>
								</table>
							<?php
						}
						else
						{
							echo "<span style='color: red;'>Cart is empty.</span>";
						}
						?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php
	require 'inc/footer.php';
?>