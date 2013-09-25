<?php
/* @var $this SchoolClassController */
/* @var $model SchoolClass */

$this->breadcrumbs=array(
	'School Class'=>array('index'),
	$model->id,
);

?>


<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View School Class <?php echo $model->id; ?></h3>
		</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'class_name',
		'grade_id_fk',
	),
)); ?>
</div>
