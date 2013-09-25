<?php
/* @var $this PatternsController */
/* @var $model Patterns */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Patterns', 'url'=>array('index')),
	array('label'=>'Manage Patterns', 'url'=>array('admin')),
);

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
?>

<div class="module width_full">

	<div class="header">
	  <h3>Create Patterns</h3>
	</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>