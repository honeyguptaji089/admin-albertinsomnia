<?php
/* @var $this PatternsController */
/* @var $model Patterns */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Patterns', 'url'=>array('index')),
	array('label'=>'Create Patterns', 'url'=>array('create')),
	array('label'=>'Update Patterns', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Patterns', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Patterns', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View Pattern <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cards',
		'functions',
		'max_target',
	),
)); ?>
</div>