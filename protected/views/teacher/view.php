<?php
/* @var $this TeacherController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->id,
);

?>

<div class="module width_full">
	<div class="header">
	  <h3>View Teacher <?php echo $model->id; ?></h3>
	</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'teacher_name',
		'teacher_address',
		'teacher_phone_no',
		'user_id_fk',
		'teacher_code',
	),
)); ?>
</div>