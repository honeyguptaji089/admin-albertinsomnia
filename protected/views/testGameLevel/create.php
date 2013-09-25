<?php
/* @var $this TestGameLevelController */
/* @var $model TestGameLevel */

$this->breadcrumbs=array(
	'Test Game Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestGameLevel', 'url'=>array('index')),
	array('label'=>'Manage TestGameLevel', 'url'=>array('admin')),
);
?>

<h1>Create TestGameLevel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>