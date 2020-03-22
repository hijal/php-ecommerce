<?php require "inc/header.php"; ?>
<?php
    $login      = Session::get('login');
    $user_id    = Session :: get('id'); 

	if($login == false)
	{
		header('Location: login.php');
    }
    
    if(isset($_GET['order_id']) and $_GET['order_id'] == 'order')
    {
        $order      = $cart -> order_insert($user_id);
        $delData    = $cart -> delete_cart_data();

        header('Location: success.php');
    }

    $cart_product     = $cart -> get_cart_list();
    $userData         = $user -> getUserData($user_id);
?>

<style>
    .division
    {
        width: 50%;
        float: left;   
    }
    .tblone
    {
        margin: 0 auto;
        border: 2px solid #ddd;
        width: 500px;
    }
    .tblone tr td
    {
        text-align: justify;
    }
    .tbltwo
    {
        float:right;
        text-align:left;
        width: 50%;
        border : 2px solid #ddd;
        margin-right: 14px;
        margin-top: 12px;
    }
    .tbltwo tr td
    {
        text-align: justify;
        padding : 5px 10px;
    }
    .order 
    {
        padding-bottom : 10px;
    }
    .order a
    {
        width: 200px;
        margin : 20px auto 0;
        text-align: center;
        padding : 5px;
        font-size : 20px;
        display: block;
        background : #ff0000;
        border-radius : 3px;
        color : #fff;
    }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division">
            <table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
							<?php
								
								if($cart_product)
								{
									$i = 0;
                                    $sum = 0;
                                    $qty = 0;

									while($data = $cart_product->fetch_assoc())
									{
										$i++;
							?>
							
							<tr>
								<td><?= $i?></td>
								<td><?= $data['product_name']; ?></td>
								<td><?= $data['price']; ?></td>
                                <td><?= $data['quantity']; ?></td>

                                <td><?php
                                    $total =  $data['price'] * $data['quantity'];
                                    echo ($total); 
                                 ?></td>
							</tr>
							<?php
                                $sum += $total;
                                $qty += $data['quantity'];
								Session::set('sum', $sum);
									}
								}
							?>
						</table>
                        <table class="tbltwo" width="50%">
										<tr>
											<th>Sub Total : </th>
											<td><?= $sum; ?> TK</td>
										</tr>
										<tr>
											<th>VAT : </th>
											<td>10%</td>
										</tr>
										<tr>
											<th>Grand Total :</th>
											<td>
												<?php
													$vat            = $sum * (10 / 100);
													$grand_total    = $sum + $vat;
													echo $grand_total. " TK";
												
												?>
											</td>
										</tr>
                                        <tr>
                                        <th>Quantity: </th>
                                            <td>
                                                <?= $qty; ?>
                                            </td>
                                        </tr>
								</table>
            </div>
            <div class="division">
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
            ?>
            </div>
        </div>
        <div class="order"><a href="?order_id=order">order</a></div>
    </div>
    
</div>

<?php
    include 'inc/footer.php';
?>