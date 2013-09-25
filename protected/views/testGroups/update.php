<?php
/* @var $this TestGroupsController */
/* @var $model TestGroups */

$this->breadcrumbs=array(
	'Test Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestGroups', 'url'=>array('index')),
	array('label'=>'Create TestGroups', 'url'=>array('create')),
	array('label'=>'View TestGroups', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TestGroups', 'url'=>array('admin')),
);
?>

<h1>Update TestGroups <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>