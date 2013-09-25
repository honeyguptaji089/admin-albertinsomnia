<?php
/* @var $this TestGameLevelController */
/* @var $model TestGameLevel */

$this->breadcrumbs=array(
	'Test Game Levels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TestGameLevel', 'url'=>array('index')),
	array('label'=>'Create TestGameLevel', 'url'=>array('create')),
	array('label'=>'Update TestGameLevel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestGameLevel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestGameLevel', 'url'=>array('admin')),
);
?>

<h1>View TestGameLevel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'test_id_fk',
		'game_level_id_fk',
	),
)); ?>
