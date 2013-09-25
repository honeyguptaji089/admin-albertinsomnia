<?php
/* @var $this PatternsController */
/* @var $model Patterns */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Patterns', 'url'=>array('index')),
	array('label'=>'Create Patterns', 'url'=>array('create')),
	array('label'=>'View Patterns', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Patterns', 'url'=>array('admin')),
);

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Update Pattern</h3>
		</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>