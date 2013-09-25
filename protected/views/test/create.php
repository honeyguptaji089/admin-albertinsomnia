<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Create',
);

?>
<div class="module width_full">

	<div class="header">
	  <h3>Create Test</h3>
	</div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>