<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->id,
);

?>

<div class="module width_full">

	<div class="header">
	  <h3>View Test</h3>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'test_name',
			'test_description',
			'date',
		),
)); ?>
</div>