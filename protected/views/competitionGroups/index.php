<?php
/* @var $this CompetitionGroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competition Groups',
);

$this->menu=array(
	array('label'=>'Create CompetitionGroups', 'url'=>array('create')),
	array('label'=>'Manage CompetitionGroups', 'url'=>array('admin')),
);
?>

<h1>Competition Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
