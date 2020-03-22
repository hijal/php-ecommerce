<?php 
	require "inc/header.php"; 
	require "inc/slider.php";


?>
<?php  
	$featured 		= $product ->  get_featured_products();
	$new 			= $product -> get_new_products();
?>
	
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php 
				
				if($featured)
				{
					while($data = $featured->fetch_assoc())
					{     
				?>
					
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']; ?>" height="50%" alt="" /></a>
					<h2><?= $data['name']; ?> </h2>
					<p><?= $data['body']; ?></p>
					<p><span class="price">$<?= $data['price']; ?></span></p>
				    <div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>" class="details">Details</a></span></div>
				</div>	
				<?php 
				}
			}
		?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
				
				if($new)
					{
						while($data = $new->fetch_assoc())
					{
				?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']; ?>" height="50%" alt="" /></a>
					<h2><?= $data['name']; ?> </h2>
					<p><?= $data['body']; ?></p>
					<p><span class="price">$<?= $data['price']; ?></span></p>
				    <div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } }
				?>
			</div>
    </div>
 </div>
</div>

<?php require 'inc/footer.php'; ?>
    