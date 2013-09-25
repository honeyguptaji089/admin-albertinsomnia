<?php
/* @var $this TestGroupsController */
/* @var $model TestGroups */

$this->breadcrumbs=array(
	'Test Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TestGroups', 'url'=>array('index')),
	array('label'=>'Create TestGroups', 'url'=>array('create')),
	array('label'=>'Update TestGroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestGroups', 'url'=>array('admin')),
);
?>

<h1>View TestGroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'test_id_fk',
		'group_id_fk',
	),
)); ?>
