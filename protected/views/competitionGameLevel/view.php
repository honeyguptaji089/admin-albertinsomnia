<?php
/* @var $this CompetitionGameLevelController */
/* @var $model CompetitionGameLevel */

$this->breadcrumbs=array(
	'Competition Game Levels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CompetitionGameLevel', 'url'=>array('index')),
	array('label'=>'Create CompetitionGameLevel', 'url'=>array('create')),
	array('label'=>'Update CompetitionGameLevel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompetitionGameLevel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionGameLevel', 'url'=>array('admin')),
);
?>

<h1>View CompetitionGameLevel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'game_level_id_fk',
		'comptetition_id_fk',
	),
)); ?>
