<?php require "inc/header.php"; ?>
<?php
    $login      = Session::get('login');
    $user_id    = Session::get("id");

	if($login == false)
	{
		header('Location: login.php');
    }
    
    if(isset($_GET['confirm']))
	{
		$user_id    = $_GET['confirm'];
		$time       = $_GET['date'];
		$price      = $_GET['price'];
		$confirm    = $cart -> product_confirm($user_id, $price, $time);
    }
    if(isset($_GET['delShift']))
	{
		$id         = $_GET['delShift'];
		$time       = $_GET['date'];
		$price      = $_GET['price'];
		$is_deleted = $cart -> deleted_shifted_product($id, $price, $time);
    }

    $product        = $cart -> get_order_product($user_id);
?>

<style type="text/css">

table.tblone a {
  color: #fe5800;
  font-weight: bold;
  text-decoration: none;
  margin-left: 0px;
}

</style>

<div class="main">
    <div class="content">
	    <div class="section group">
            <div class="order">
                <h2 >
                    Your order details
                </h2>
                <table class="tblone" style="width: 100%;">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity </th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
							<?php
                                
								if($product)
								{
									$i = 0;

									while($data = $product->fetch_assoc())
									{
										$i++;
							?>
							
							<tr>
								<td><?= $i?></td>
								<td><?= $data['product_name']; ?></td>
								<td><img src="admin/<?= $data['image']; ?>" alt=""/></td>
								<td><?= $data['quantity']; ?></td>
                                <td>
                                    <?php  
                                        echo  $data['price'];
                                    ?>
                                </td>
                                <td>
                                    <?php echo $format->formatDate($data['date']); ?>
                                </td>
                                <td>
                                    <?php 
                                        if($data['status'] == '0') 
                                        {
                                            echo "Pending";
                                        }
                                        elseif($data['status'] == '1')
                                        {?>
                                            <a href="?confirm=<?= $user_id; ?>&price=<?= $data['price']; ?>&date=<?= $data['date']; ?>">Shifted</a>
                                        <?php
                                        }
                                        else
                                        {
                                            echo "Confirm";
                                        }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($data['status'] == '2')
                                        {?>
                                        
                                        <a href="?delShift=<?= $user_id; ?>&price=<?= $data['price']; ?>&date=<?= $data['date']; ?>" onClick="window.location.reload()">X</a>
                                            <?php
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                    ?>
                                </td>
                                <td>
                                    
                                </td>
							</tr>
							<?php
									}
								}
							?>
						</table>
            </div>
		</div>
    </div>
 </div>

<?php require 'inc/footer.php'; ?>
    