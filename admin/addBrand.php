<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    require '../classess/Brand.php';

    $brand   = new Brand();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_brand']))
	{
        $brand_name     =  $_POST['brand_name'];
		$is_inserted    =  $brand -> insert($brand_name);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
                <div style="width:50%; text-align: center;">
                <?php
                    if(isset($is_inserted))
                    {
                        echo "<span style=color: green; font-size: 20px;>$is_inserted</span>";
                    }
                ?>
                </div>
               <div class="block copyblock"> 
                
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brand_name" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="add_brand" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>