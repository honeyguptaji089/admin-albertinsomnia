<?php
/* @var $this PatternsController */
/* @var $model Patterns */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	'Upload',
);

$this->menu=array(
);

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
?>

<div class="module width_full">

	<div class="header">
	  <h3>Upload Patterns</h3>
	</div>
<?php echo $this->renderPartial('_uploadForm', array('model'=>$model)); ?>
</div>