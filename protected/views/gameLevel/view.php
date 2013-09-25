<?php
/* @var $this GameLevelController */
/* @var $model GameLevel */

$this->breadcrumbs=array(
	'Game Levels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GameLevel', 'url'=>array('index')),
	array('label'=>'Create GameLevel', 'url'=>array('create')),
	array('label'=>'Update GameLevel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GameLevel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GameLevel', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View GameLevel <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'level_name',
	),
)); ?>
</div>