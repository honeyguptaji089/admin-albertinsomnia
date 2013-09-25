<?php
/* @var $this AdvertisementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Advertisements',
);

?>


<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Advertisements</h3>
		</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>