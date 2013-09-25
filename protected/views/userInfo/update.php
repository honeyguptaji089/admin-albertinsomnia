<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

	$this->breadcrumbs=array(
	);

	if(isset($_GET['message'])&& intVal($_GET['message'])){
		echo "<div class='".$this->message_type."'>".$this->message."</div>";
	}

?>

<div class="module width_full">
	<div class="header">
	  <h3>Update Password Information</h3>
	</div>
	
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>