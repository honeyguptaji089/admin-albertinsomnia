<?php
/* @var $this SchoolGradesController */
/* @var $model SchoolGrades */

$this->breadcrumbs=array(
	'School Grades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SchoolGrades', 'url'=>array('index')),
	array('label'=>'Create SchoolGrades', 'url'=>array('create')),
	array('label'=>'View SchoolGrades', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SchoolGrades', 'url'=>array('admin')),
);
?>

<h1>Update SchoolGrades <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>