<?php
/* @var $this SchoolGradesController */
/* @var $model SchoolGrades */

$this->breadcrumbs=array(
	'School Grades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SchoolGrades', 'url'=>array('index')),
	array('label'=>'Create SchoolGrades', 'url'=>array('create')),
	array('label'=>'Update SchoolGrades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SchoolGrades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SchoolGrades', 'url'=>array('admin')),
);
?>

<h1>View SchoolGrades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'grade_name',
		'school_id_fk',
	),
)); ?>
