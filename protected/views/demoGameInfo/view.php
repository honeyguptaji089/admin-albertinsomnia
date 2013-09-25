<?php
/* @var $this DemoGameInfoController */
/* @var $model DemoGameInfo */

$this->breadcrumbs=array(
	'Demo Game Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DemoGameInfo', 'url'=>array('index')),
	array('label'=>'Create DemoGameInfo', 'url'=>array('create')),
	array('label'=>'Update DemoGameInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DemoGameInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DemoGameInfo', 'url'=>array('admin')),
);
?>

<h1>View DemoGameInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'player_id_fk',
		'score',
		'last_level_string',
	),
)); ?>
