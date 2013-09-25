<?php
/* @var $this SchoolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Schools',
);

$this->menu=array(
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Schools</h3>
		</div>
		
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>