<?php require "inc/header.php"; ?>

<?php
	$login = Session::get('login');
	
	if($login == true)
	{
		header('Location: index.php');
	}
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
	{
		$Login 	= $user->login($_POST);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']))
	{
		$registration 	=  $user->registration($_POST);
	}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
				<?php
					if(isset($Login))
					{
						echo "<span style='color: red; font-size: 20px;'> $Login </span>";
					}
					else
					{
						echo "<p>Sign in with the form below.</p>";
					}
				?>
        		<form action="" method="post">
                	<input name="email" type="text" placeholder="Email" class="field">
                    <input name="password" type="password" placeholder="Password" class="field">
					<div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                </form>    
        </div>
    	<div class="register_account">
			<?php
				if(isset($registration))
				{
					echo "<span style='color: red; font-size: 20px;'>$registration</span>";
				}
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-Mail"/>
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
					<select id="country" name="country">
						<option value="null">Select a Country</option>         
						<option value="Afghanistan">Afghanistan</option>
						<option value="Albania">Albania</option>
						<option value="DZ">Algeria</option>
						<option value="Algeria">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Australia">Australia</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaijan">Azerbaijan</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Bangladesh">Bangladesh</option>

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php require 'inc/footer.php'; ?>
