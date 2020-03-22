<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	require '../classess/Product.php';
	require_once '../helpers/Format.php';	
?>

<?php 
	$product 		= new Product();
	$format 		= new Format();

	$product_row 	= $product -> get_all_product();
	
	if(isset($_GET['product_id']))
	{
		$id 		= $_GET['product_id'];
		$is_deleted = $product -> delete($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
			<?php
				
				if(isset($is_deleted))
				{
					echo "<span style='color : red; font-size='22px';'>$is_deleted</span>";
				}
				
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category ID</th>
					<th>Brand ID</th>
					<th>Body</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($product_row)
					{
						$i = 0;
						while($data = $product_row->fetch_assoc())
						{
							$i++;
				?> 
						<tr class="odd gradeX">
							<td><?= $i ?></td>
							<td><?= $data['name']; ?></td>
							<td><?= $data['category_name']; ?></td>
							<td class="center"> <?= $data['brand_name']; ?></td>
							<td class="center"> <?= $format->textShorten($data['body'], 50); ?></td>
							<td class="center"> $<?= $data['price']; ?></td>
							<td class="center"> 
								<img src="<?= $data['image']; ?>" height="40px" width="60px" alt="">
							</td>
							<td class="center">
								<?php
									if($data['type'] == 0)
									{
										echo "Featured";
									}
									else
									{
										echo "Non-Featured";
									}
								?>
							</td>
							<td><a href="productEdit.php?product_id=<?= $data['id']?>">Edit</a> 
							|| 
							<a onclick="return confirm('Are you Confirm To Delete?')" href="?product_id=<?= $data['id'];?>">Delete</a></td>
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
