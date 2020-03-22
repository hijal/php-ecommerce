<?php 
    include 'inc/header.php';

    $login      = Session :: get('login');
    $user_id    = Session :: get('id');
    $userData   = $user -> getUserData($user_id);

    if($login == false)
    {
        header('Location: login.php');
    }

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
            <table class="tblone">
                <tr style="background: blue;">
                    <td></td>
                    <td></td> 
                   <td>
                        <h5 style="color: white;">Your Profile</h5>
                   </td>
                </tr>
                <tr>
                    <td width="20%">Name</td>
                    <td width="5%">:</td>
                    <td><?= $info['name']; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?= $info['phone']; ?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td><?= $info['email']; ?></td>
                </tr>
                <tr>
                    <td>city</td>
                    <td>:</td>
                    <td><?= $info['city']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?= $info['address']; ?></td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td>:</td>
                    <td><?= $info['zipcode']; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td>user name</td>
                </tr>
                <tr style="background: blue;">
                    <td></td>
                    <td></td>
                    <td>
                        <a href="editProfile.php" style="color: white;" >Update Profile</a>
                    </td>
                </tr>
            </table>
            <?php

                }
            }
            else
            {
                echo "<span style='color: red; font-size: 19px;'>No data available.</span>";
            }
        ?>
        </div>
    </div>
</div>

<?php
    include 'inc/footer.php';
?>