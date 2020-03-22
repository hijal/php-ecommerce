<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 

    $filePath   = realpath(dirname(__FILE__));
	include_once ($filePath.'/../classess/User.php');
?>

<?php

    
    if(!isset($_GET['user_id']) || $_GET['user_id'] == null)
    {
        echo "<script> window.location = 'inbox.php'; </script>";
    }
    else
    {
        $id     = $_GET['user_id'];
    }

    $customer       = new User();
    $getCustomer    = $customer->getUserData($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
        echo "<script> window.location = 'inbox.php'; </script>";
    }

?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Customer Details</h2>
        <div class="block copyblock"> 

        <?php
            if($getCustomer)
            {
                while($result = $getCustomer->fetch_assoc())
                {
            ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['address']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['city']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Zip code</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['zipcode']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['phone']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?= $result['email']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Ok" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php } } ?>
    </div>
<?php include 'inc/footer.php';?>

<script>
    $("#cat").slideUp(2000, function() 
    {
        $(this).remove();
    });
</script>