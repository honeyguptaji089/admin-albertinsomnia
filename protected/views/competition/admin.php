<?php
/* @var $this CompetitionController */
/* @var $model Competition */

$this->breadcrumbs=array(
	'Competitions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Competition', 'url'=>array('index')),
	array('label'=>'Create Competition', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('competition-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}

?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="module width_3_quarter timeGridView">
		<div class="header">
			<h3 class="tabs_involved">View Competitions</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'competition-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'competition_name',
		array(
				'header'=>'Date',
				'name'=>'date',
				'value'=>'$data->getDate($data->date)',
			),
		array(
			'header'=>'Have Limited Time Target',
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
						'label'=>'Show Competition Time in Different Timezone',
						'imageUrl'=>Yii::app()->request->baseUrl.'/images/world_time.png',
						'url'=>'Yii::app()->createUrl("competition/time", array("id"=>$data->id))',
						'class'=>'cool'
					),
				)	
		),
	),
)); ?>
</div>