<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    require '../classess/Category.php';

    $category   = new Category();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category']))
	{
        $category_name       =  $_POST['category_name'];
		$is_inserted         =  $category -> insert($category_name);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
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
                                <input type="text" name="category_name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="add_category" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>