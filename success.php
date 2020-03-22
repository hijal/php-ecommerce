<?php require "inc/header.php"; ?>
<?php
    $login = Session::get('login');
    $user_id    = Session::get("id");

	if($login == false)
	{
		header('Location: login.php');
    }
    
    $amount     = $cart -> payableAmount($user_id);

    if($amount)
    {
        $sum    = 0;
        while($result = $amount -> fetch_assoc())
        {
            $price      = $result['price'];
            $sum        += $price;
        }
    }
?>

<style>
    .success
    {
        width: 500px;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
        min-height: 200px;
        text-align: center;
    }
    .success h2
    {
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom : 10px;
    }
    .success p
    {
        border-radius: 3px;
        font-size : 20px;
        line-height: 25px;
        padding: 5px 30px;
        text-align: justify;
    }


</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="success">
                <h2>Success</h2>
                <p>Total payable amount (including vat) : $<?php 

                    $vat    = $sum * 0.1;
                    $total  = $sum + $vat;
                    echo intval($total);

                ?></p>
                <p>
                Your order received successfully. Thank you for your purchase.
                we will contact as soon as posible.
                here is your order details ....
                <a href="orders.php">visit here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
    include 'inc/footer.php';
?>