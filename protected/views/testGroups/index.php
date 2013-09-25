<?php
/* @var $this TestGroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test Groups',
);

$this->menu=array(
	array('label'=>'Create TestGroups', 'url'=>array('create')),
	array('label'=>'Manage TestGroups', 'url'=>array('admin')),
);
?>

<h1>Test Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
