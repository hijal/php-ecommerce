<?php

	$brand_one 		= $product -> latest_from_sony();
	$brand_two 		= $product -> latest_from_Whirlpool();
	$brand_three 	= $product -> latest_from_Samsung();
	$brand_four 	= $product -> latest_from_Vaxcel();
?>

<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					if($brand_one)
					{
						while($data = $brand_one->fetch_assoc())
						{
							?>
								<div class="listview_1_of_2 images_1_of_2">
									<div class="listimg listimg_2_of_1">
										<a href="preview.php?product_id=<?= $data['id']; ?>"> <img src="admin/<?= $data['image']; ?>" alt="" /></a>
									</div>
									<div class="text list_2_of_1">
										<h2><?= $data['name']; ?></h2>
										<p><?= $data['body']; ?></p>
										<div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>">Add to cart</a></span></div>
									</div>
								</div>
							<?php
						}
					}
				?>	
				<?php
					if($brand_two)
					{
						while($data = $brand_two->fetch_assoc())
						{
							?>
							<div class="listview_1_of_2 images_1_of_2">
								<div class="listimg listimg_2_of_1">
									<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']?>" alt="" /></a>
								</div>
								<div class="text list_2_of_1">
									<h2><?= $data['name']; ?></h2>
									<p><?= $data['body']; ?></p>
									<div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>">Add to cart</a></span></div>
								</div>
							</div>
							<?php
						}
					}
				?>
				
			</div>
			<div class="section group">
				<?php
					if($brand_three)
					{
						while($data = $brand_three -> fetch_assoc())
						{
							?>

						<div class="listview_1_of_2 images_1_of_2">
							<div class="listimg listimg_2_of_1">
							<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']?>" alt="" /></a>
							</div>
							<div class="text list_2_of_1">
								<h2><?= $data['name']; ?></h2>
								<p><?= $data['body']; ?></p>
								<div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>">Add to cart</a></span></div>
							</div>
						</div>
							<?php
						}
					}
				?>

				<?php
					if($brand_four)
					{
						while($data = $brand_four -> fetch_assoc())
						{
							?>

						<div class="listview_1_of_2 images_1_of_2">
							<div class="listimg listimg_2_of_1">
							<a href="preview.php?product_id=<?= $data['id']; ?>"><img src="admin/<?= $data['image']?>" alt="" /></a>
							</div>
							<div class="text list_2_of_1">
								<h2><?= $data['name']; ?></h2>
								<p><?= $data['body']; ?></p>
								<div class="button"><span><a href="preview.php?product_id=<?= $data['id']; ?>">Add to cart</a></span></div>
							</div>
						</div>
							<?php
						}
					}
				?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>