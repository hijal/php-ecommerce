<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    require '../classess/Product.php';
    require '../classess/Category.php';
    require '../classess/Brand.php';
?>

<?php 
    $category           = new Category();
    $product            = new Product();
    $brand              = new Brand();

    $category_list      = $category -> get_all_category();
    $brand_list         = $brand -> get_all_brand();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_inserted   =  $product -> insert($_POST, $_FILES);
	}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
        <?php
            if(isset($is_inserted))
            {
                echo "<span style='color:red; font-size=18px; text-align=center;'>$is_inserted</span>";
            }
        ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category_id">
                            <option>Select Category</option>
                            <?php 
                                if($category_list)
                                {
                                    while($result = $category_list -> fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?= $result['id']; ?>"><?= $result['name'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            

                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand_id">
                            <option>Select Brand</option>
                            <?php 
                                if($brand_list)
                                {
                                    while($result = $brand_list -> fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?= $result['id']; ?>"><?= $result['name'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


