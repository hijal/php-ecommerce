<?php 
    include 'inc/header.php';

    $login      = Session :: get('login');
    $user_id    = Session :: get('id');

    if($login == false)
    {
        header('Location: login.php');
    }
    
    

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
	{
		$is_updated     = $user->update($_POST, $user_id);
    }
    $user_id    = Session :: get('id');
    $userData    = $user->getUserData($user_id);
?>

<style>
    .tblone
    {
        margin: 0 auto;
        border: 2px solid #ddd;
        width: 550px;
    }
    .tblone tr td
    {
        text-align: justify;
    }
    .tblone input[type='text']
    {
        width:400px;
        padding:5px;
        font-size:15px;
    }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <?php
                
                if($userData)
                {
                    while($info = $userData->fetch_assoc())
                    {
            ?>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <?php
                                if(isset($is_updated))
                                echo $is_updated;
                            ?>
                        </td>
                    </tr>
                    <tr style="background: blue;">
                        <td></td>
                        <td></td> 
                    <td>
                            <h5 style="color: white;">Update Your Profile</h5>
                    </td>
                    </tr>
                    <tr>
                        <td width="20%">Name</td>
                        <td width="5%">:</td>
                        <td><input type="text" name="name" value="<?= $info['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?= $info['phone']; ?>"></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td><input type="text" name="email" value="<?= $info['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td>city</td>
                        <td>:</td>
                        <td><input type="text" name="city" value="<?= $info['city']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?= $info['address']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td>:</td>
                        <td><input type="text" name="zipcode" value="<?= $info['zipcode']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><input type="text" name="country" value="<?= $info['country']; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="save">
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

<?php
    include 'inc/footer.php';
?>