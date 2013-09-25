<?php
/* @var $this GroupPlayerController */
/* @var $model GroupPlayer */

$this->breadcrumbs=array(
	'Group Players'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupPlayer', 'url'=>array('index')),
	array('label'=>'Create GroupPlayer', 'url'=>array('create')),
	array('label'=>'Update GroupPlayer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupPlayer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupPlayer', 'url'=>array('admin')),
);
?>

<h1>View GroupPlayer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'player_id_fk',
		'group_id_fk',
	),
)); ?>
