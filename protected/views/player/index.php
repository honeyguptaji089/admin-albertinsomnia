<?php
/* @var $this PlayerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Players',
);

$this->menu=array(
	array('label'=>'Create Player', 'url'=>array('create')),
	array('label'=>'Manage Player', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Player</h3>
		</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
