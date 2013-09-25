<?php
/* @var $this TestGameLevelController */
/* @var $model TestGameLevel */

$this->breadcrumbs=array(
	'Test Game Levels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestGameLevel', 'url'=>array('index')),
	array('label'=>'Create TestGameLevel', 'url'=>array('create')),
	array('label'=>'View TestGameLevel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TestGameLevel', 'url'=>array('admin')),
);
?>

<h1>Update TestGameLevel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>