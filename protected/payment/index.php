<?php
	$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
	$paypal_id='dpkagpta01-facilitator@gmail.com'; // Business email ID


?>

<div style='background: url(../images/main_logo.png) center -70px no-repeat;height: 390px;'></div>
<?php
	$connection=mysql_connect("localhost","root","");
	mysql_select_db("game_portal_db");
	$player_id=$_GET['pi'];
	
	$playerNameQuery="SELECT p.id, p.player_name, p.payment_status, p.player_type FROM game_portal_db.player p WHERE p.id=".$player_id;
	$result=mysql_query($playerNameQuery);
	$row=@mysql_fetch_array($result);
	if(intVal($row['payment_status'])===1){
		echo "<p style='text-align: center;'><b>".$row['player_name']."</b> Your payment already done. No need to pay Again.<img src='smile.jpg' style='display: block;height: 100px;width: 100px;margin: 0 auto;'/></p>";
	}
	else{
		echo "<p style='text-align: center;'>Hi! <b>".$row['player_name']."</b> Please click below button to pay $2.99 USD for Albert Instomania 2.0.</p>";
	?>
		<div style='text-align: center;'>
			<form action='<?php echo $paypal_url; ?>' method='post' name='form1'>
			<input type='hidden' name='business' value='<?php echo $paypal_id; ?>'>
			<input type='hidden' name='cmd' value='_xclick'>
			<input type='hidden' name='item_name' value='Albert Instomania 2.0'>
			<input type='hidden' name='item_number' value='1'>
			<input type='hidden' name='amount' value='2.99'>
			<input type='hidden' name='no_shipping' value='1'>
			<input type='hidden' name='currency_code' value='USD'>
			<input type='hidden' name='cancel_return' value='http://localhost/game_portal/payment/cancel.php?pi=<?php echo $player_id;?>'>
			<input type='hidden' name='return' value='http://localhost/game_portal/payment/success.php?pi=<?php echo $player_id;?>'>
			<input type="image" src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
			</form>
		</div> 
	<?php
	}
?>