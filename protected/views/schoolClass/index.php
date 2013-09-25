<?php
/* @var $this SchoolClassController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'School Class',
);

$this->menu=array(
	array('label'=>'Create SchoolClass', 'url'=>array('create')),
	array('label'=>'Manage SchoolClass', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">School Class</h3>
		</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>