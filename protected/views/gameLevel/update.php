<?php
/* @var $this GameLevelController */
/* @var $model GameLevel */

$this->breadcrumbs=array(
	'Game Levels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GameLevel', 'url'=>array('index')),
	array('label'=>'Create GameLevel', 'url'=>array('create')),
	array('label'=>'View GameLevel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GameLevel', 'url'=>array('admin')),
);
?>

<div class="module width_full">

	<div class="header">
	  <h3>Update Game Level</h3>
	</div>
	
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>

</div>