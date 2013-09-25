<?php
/* @var $this PlayerController */
/* @var $model Player */

$this->breadcrumbs=array(
	'Players'=>array('index'),
	'Upload',
);


if(isset($_GET['message'])&& intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>
<div class="module width_full">

	<div class="header">
	  <h3>Upload Player</h3>
	</div>

<?php echo $this->renderPartial('_uploadForm', array('model'=>$model)); ?>
</div>