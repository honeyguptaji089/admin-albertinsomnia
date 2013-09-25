<?php
/* @var $this CompetitionGroupsController */
/* @var $model CompetitionGroups */

$this->breadcrumbs=array(
	'Competition Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompetitionGroups', 'url'=>array('index')),
	array('label'=>'Create CompetitionGroups', 'url'=>array('create')),
	array('label'=>'Update CompetitionGroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompetitionGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionGroups', 'url'=>array('admin')),
);
?>

<h1>View CompetitionGroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id_fk',
		'competition_id_fk',
	),
)); ?>
