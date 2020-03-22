<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    require '../classess/Product.php';
    require '../classess/Category.php';
    require '../classess/Brand.php';
?>

<?php 
    
    if(!isset($_GET['product_id']) || $_GET['product_id'] == null)
    {
        echo "<script> window.location = 'productlist.php'; </script>";
    }
    else
    {
        $id     = $_GET['product_id'];
    }
    
    $category   = new Category();
    $brand      = new Brand();
    $product    = new Product();

    $category_row   = $category -> get_all_category();
    $brand_row      = $brand -> get_all_brand();
    $product_row    = $product -> get_product_by_id($id);

    

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_update']))
	{
		$is_update    =  $product -> update($_POST, $_FILES, $id);
    }
    
    
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
        <?php
            if(isset($is_update))
            {
                echo "<span style='color:red; font-size=18px; text-align=center;'>$is_update</span>";
            }
        ?>   
        <?php
            if($product_row)
            {
                while($data = $product_row->fetch_assoc())
                {
        ?>  
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?= $data['name']?>" class="medium" />
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
                                    if($category_row)
                                    {
                                        while($result = $category_row -> fetch_assoc())
                                        {
                                ?>
                                            <option <?php if($data['id'] == $result['id']) { ?> selected="selected" <?php }  ?>
                                            value="<?= $result['id']; ?>"><?= $result['name'] ?></option>  
                                            
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
                                    if($brand_row)
                                    {
                                        while($result = $brand_row -> fetch_assoc())
                                        {
                                            ?>
                                            <option <?php if($data['id'] == $result['id']) { ?> selected="selected" <?php }  ?> value="<?= $result['id']; ?>"><?= $result['name'] ?></option>
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
                            <textarea class="tinymce" name="body" value=""><?= $data['body']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $data['price']; ?>" class="medium" />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?= $data['image']; ?>" height="80px" width="100px" alt="">
                            <br>
                            <input type="file" name="image"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if($data['type'] == 0)
                                    {
                                ?>
                                    <option selected="selected" value="0">Featured</option>
                                    <option value="1">Non-Featured</option>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <option  value="0">Featured</option>
                                        <option selected="selected" value="1">Non-Featured</option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="product_update" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php
                }
            }
        ?>            
         
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


