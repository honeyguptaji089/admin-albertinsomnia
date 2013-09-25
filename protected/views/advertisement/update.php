<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs=array(
	'Advertisements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<div class="module width_full">

	<div class="header">
	  <h3>Update Advertisement</h3>
	</div>
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>