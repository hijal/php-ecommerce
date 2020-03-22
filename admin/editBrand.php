<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    require '../classess/Brand.php';

    
    if(!isset($_GET['id']) || $_GET['id'] == null)
    {
        echo "<script> window.location = 'catlist.php'; </script>";
    }
    else
    {
        $id = $_GET['id'];
    }

    $brand       = new Brand();
    $brand_row   = $brand -> get_brand_by_id($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_brand']))
	{
        $brand_name     = $_POST['brand_name'];
		$is_ipdated     =  $brand -> update($brand_name, $id);
    }

?>
    <div class="grid_10">
        
        <div class="box round first grid">
            <h2>Update Category</h2>
            <div style="width:50%; text-align: center;">
            <?php 
                if(isset($is_ipdated))
                {
                    echo "<span id='cat' style='color: red; font-size: 18px;'>$is_ipdated</span>";
                }
            ?>
            </div>
        <div class="block copyblock"> 
        
        <?php
            if($brand_row)
            {
                while($result = $brand_row->fetch_assoc())
                {
            ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="brand_name" value="<?= $result['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="edit_brand" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php 
            } 
        } 
        ?>
    </div>
<?php include 'inc/footer.php';?>
