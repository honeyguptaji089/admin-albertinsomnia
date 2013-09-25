<div style='background: url(../images/main_logo.png) center -70px no-repeat;height: 390px;'></div>
<?php
	$connection=mysql_connect("localhost","root","");
	mysql_select_db("game_portal_db");
	$player_id=$_GET['pi'];
	$pay_url="http://localhost/game_portal/payment/?pi=".$player_id;
	
	$playerNameQuery="SELECT p.id, p.player_name, p.payment_status, p.player_type FROM game_portal_db.player p WHERE p.id=".$player_id;
	$result=mysql_query($playerNameQuery);
	$row=@mysql_fetch_array($result);
	if(intVal($row['payment_status'])!==1){
		echo "<p style='text-align: center;'>Sorry <b>".$row['player_name']."</b> your payment has not done Successfully please <a href='".$pay_url."'>try again</p>";
	}
?>