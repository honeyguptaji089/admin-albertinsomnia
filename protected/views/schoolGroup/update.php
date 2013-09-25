<?php
/* @var $this SchoolGroupController */
/* @var $model SchoolGroup */

$this->breadcrumbs=array(
	'School Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<div class="module width_full">

	<div class="header">
	  <h3>Update SchoolGroup</h3>
	</div>
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>