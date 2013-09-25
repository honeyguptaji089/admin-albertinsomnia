<?php
/* @var $this AdvertisementClickController */
/* @var $model AdvertisementClick */


if(intVal(Yii::app()->user->user_type)==1){
	
	$this->breadcrumbs=array();
}
else{
	$this->breadcrumbs=array(
		'Advertisement Clicks'=>array('index'),
		'Manage',
	);

}

$this->menu=array(
	array('label'=>'List AdvertisementClick', 'url'=>array('index')),
	array('label'=>'Create AdvertisementClick', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('advertisement-click-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">Advertisement Click Report</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advertisement-click-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		array(
			'header'=>'Advertisement',
			'name'=>'ad_id_fk',
			'value'=>'$data->adIdFk->ad_name'
		),
		'ip_address',
		'click_time',
		array(
			'class'=>'CButtonColumn',
			'template'=>''
		),
	),
)); ?>
</div>