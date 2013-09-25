<?php
/* @var $this SponsorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sponsors',
);

?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Sponser</h3>
		</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>