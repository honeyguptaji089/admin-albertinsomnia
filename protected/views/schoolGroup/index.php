<?php
/* @var $this SchoolGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'School Groups',
);

$this->menu=array(
	array('label'=>'Create SchoolGroup', 'url'=>array('create')),
	array('label'=>'Manage SchoolGroup', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
	<div class="header">
		<h3 class="tabs_involved">School Groups</h3>
	</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>