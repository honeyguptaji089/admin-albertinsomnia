<?php
/* @var $this TeacherController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Teachers',
);

$this->menu=array(
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<div class="module width_full">
	<div class="header">
	  <h3>Teacher</h3>
	</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
