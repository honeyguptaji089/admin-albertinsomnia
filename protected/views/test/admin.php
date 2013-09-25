<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Test', 'url'=>array('index')),
	array('label'=>'Create Test', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('test-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>

<div class="module width_3_quarter timeGridView">
		<div class="header">
			<h3 class="tabs_involved">View Test</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'test-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'template'=>'{pager}{items}{pager}',
		'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
		'columns'=>array(
			'id',
			'test_name',
			'test_description',
			array(
				'header'=>'Date',
				'name'=>'date',
				'value'=> '$data->getDate($data->date)',
			),
			array(
				'header'=>'Limited Time Target',
				'name'=>'limited_time_target',
				'value'=>array($this,'getLimitedTargetValue'),
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{time}{update}{delete}',
				'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
				'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png',
				'buttons'=>array
				(
					'time' => array
					(
						'label'=>'Show Test Time in Different Timezone',
						'imageUrl'=>Yii::app()->request->baseUrl.'/images/world_time.png',
						'url'=>'Yii::app()->createUrl("test/time", array("id"=>$data->id))',
						'class'=>'cool'
					),
				)	
			),
		),
	)); ?>
</div>