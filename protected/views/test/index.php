<?php
/* @var $this TestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tests',
);

?>

<div class="module width_full">

	<div class="header">
	  <h3>Tests</h3>
	</div>

	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
</div>
