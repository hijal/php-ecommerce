<?php 
	require "inc/header.php";

	$login 		= Session :: get('login');
	$user_id 	= Session::get("id");

    if($login == false)
    {
        header('Location: login.php');
	}
	
	$compare_list 	= $compare -> get_all_compare_list($user_id);
?>

<style>
    table.tblone img {
    height: 90px;
    width: 100px;
}
</style>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
							<?php
                                
								if($compare_list)
								{
									$i = 0;
									while($data = $compare_list->fetch_assoc())
									{
										$i++;
							?>
							<tr>
								<td><?= $i?></td>
								<td><?= $data['product_name']; ?></td>
								<td><img src="admin/<?= $data['image']; ?>" alt=""/></td>
								<td>$<?= $data['price']; ?></td>
								<td>
                                    <a href="preview.php?product_id=<?= $data['product_id']; ?>">View</a>
                                </td>
								
							</tr>
                            <?php
									}
								}
							?>              
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php require 'inc/footer.php'; ?>