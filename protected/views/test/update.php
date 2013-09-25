<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<div class="module width_full">

	<div class="header">
	  <h3>Update Test</h3>
	</div>

<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>