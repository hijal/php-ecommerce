<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';


	$filePath 	= realpath(dirname(__FILE__));
	include_once ($filePath.'/../classess/Cart.php');
	include_once ($filePath.'/../helpers/Format.php');

	$cart 	= new Cart();
	$fm 	= new Format();

	if(isset($_GET['shifted']))
	{
		$id 		= $_GET['shifted'];
		$time 		= $_GET['date'];
		$price 		= $_GET['price'];
		$shifted 	= $cart -> product_shifted($id, $price, $time);
	}

	if(isset($_GET['delShift']))
	{
		$id 		= $_GET['delShift'];
		$time 		= $_GET['date'];
		$price 		= $_GET['price'];
		$is_deleted = $cart -> deleted_shifted_product($id, $price, $time);
	}
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>User ID</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
						</tr>
					</thead>
					<tbody>

						<?php
							$order_product = $cart -> get_order_products();
							if($order_product)
							{
								$i = 0;
								while($result = $order_product -> fetch_assoc())
								{
									$i++;
									?>
										<tr class="odd gradeX">
									<td><?= $i; ?></td>
									<td><?= $fm-> formatDate($result['date']); ?></td>
									<td><?= $result['user_id']; ?></td>
									<td><?= $result['product_name']; ?></td>
									<td><?= $result['quantity']; ?></td>
									<td><?= $result['price']; ?></td>
									
									<td>
										<a href="customer.php?user_id=<?= $result['user_id']; ?>">view details</a>
									</td>
									
									<td>
										<?php
											if($result['status'] == 0)
											{
											?>
												<a id="something" href="?shifted=<?= $result['user_id']; ?>&price=<?= $result['price']; ?>&date=<?= $result['date']; ?>" onClick="window.location.reload()">Shifted</a>
											<?php
											}
											else if($result['status'] == 1)
											{
												echo "Pending";
											}
											else
											{
												?>
												<a id="something" href="?delShift=<?= $result['user_id']; ?>&price=<?= $result['price']; ?>&date=<?= $result['date']; ?>" onClick="window.location.reload()">Remove</a>
												<?php	
											}
										?>
									</td>
								</tr>
									<?php
								}
							}
						?>

						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
