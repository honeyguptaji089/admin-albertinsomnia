<?php
/* @var $this TeacherController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Create',
);

?>

<div class="module width_full">
	<div class="header">
	  <h3>Create Teacher</h3>
	</div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>