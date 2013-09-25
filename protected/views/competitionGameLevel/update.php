<?php
/* @var $this CompetitionGameLevelController */
/* @var $model CompetitionGameLevel */

$this->breadcrumbs=array(
	'Competition Game Levels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionGameLevel', 'url'=>array('index')),
	array('label'=>'Create CompetitionGameLevel', 'url'=>array('create')),
	array('label'=>'View CompetitionGameLevel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompetitionGameLevel', 'url'=>array('admin')),
);
?>

<h1>Update CompetitionGameLevel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>