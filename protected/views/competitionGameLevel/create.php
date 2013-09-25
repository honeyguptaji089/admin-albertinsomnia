<?php
/* @var $this CompetitionGameLevelController */
/* @var $model CompetitionGameLevel */

$this->breadcrumbs=array(
	'Competition Game Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionGameLevel', 'url'=>array('index')),
	array('label'=>'Manage CompetitionGameLevel', 'url'=>array('admin')),
);
?>

<h1>Create CompetitionGameLevel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>