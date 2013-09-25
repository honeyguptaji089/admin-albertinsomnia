<?php
/* @var $this SchoolGradesController */
/* @var $model SchoolGrades */

$this->breadcrumbs=array(
	'School Grades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchoolGrades', 'url'=>array('index')),
	array('label'=>'Manage SchoolGrades', 'url'=>array('admin')),
);
?>

<h1>Create SchoolGrades</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>