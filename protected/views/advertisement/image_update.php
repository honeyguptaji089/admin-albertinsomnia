<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs=array(
	'Advertisements'=>array('index'),
	'Image Update',
);


if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>
<div class="module width_full">

	<div class="header">
	  <h3>Update Advertisement Image</h3>
	</div>

<?php echo $this->renderPartial('_formImageUpdate', array('model'=>$model)); ?>
</div>