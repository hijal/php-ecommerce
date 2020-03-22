<?php 
	require "inc/header.php"; 

	if(!isset($_GET['category_id']) || $_GET['category_id'] == null)
    {
        echo "<script> window.location = 'catlist.php'; </script>";
    }
    else
    {
        $id 	= $_GET['category_id'];
	}
	
	$category   = $product -> get_product_by_category($id);
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				  <?php
					 if($category)
					 {
						 while($data = $category -> fetch_assoc())
						 {
					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']; ?>" alt="" /></a>
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
    </div>
</div>
<?php
	require 'inc/footer.php';
?>