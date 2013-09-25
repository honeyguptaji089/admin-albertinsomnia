<div style='background: url(../images/main_logo.png) center -70px no-repeat;height: 390px;'></div>
<?php
	$connection=mysql_connect("localhost","root","");
	mysql_select_db("game_portal_db");
	$player_id=$_GET['pi'];
	
	$updateQuery="UPDATE game_portal_db.player p SET p.payment_status=1 WHERE p.id=".$player_id;
	$update_result=mysql_query($updateQuery);
	if($update_result){
		$Query="SELECT p.id, p.player_name, p.payment_status, p.player_type FROM game_portal_db.player p WHERE p.id=".$player_id;
		$result=mysql_query($Query);
		$row=@mysql_fetch_array($result);
		if(intVal($row['payment_status'])===1){
			
			echo "<p style='text-align: center;'>Congrats <b>".$row['player_name']."</b> your payment done successfully. <br/> Enjoy Albert Instomania 2.0</p>";
		}
	}
	
?>