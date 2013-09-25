<?php
/* @var $this SchoolGradesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'School Grades',
);

$this->menu=array(
	array('label'=>'Create SchoolGrades', 'url'=>array('create')),
	array('label'=>'Manage SchoolGrades', 'url'=>array('admin')),
);
?>

<h1>School Grades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
