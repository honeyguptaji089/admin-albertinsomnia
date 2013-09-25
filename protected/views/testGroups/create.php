<?php
/* @var $this TestGroupsController */
/* @var $model TestGroups */

$this->breadcrumbs=array(
	'Test Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestGroups', 'url'=>array('index')),
	array('label'=>'Manage TestGroups', 'url'=>array('admin')),
);
?>

<h1>Create TestGroups</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>