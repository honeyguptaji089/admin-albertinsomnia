<?php
/* @var $this SchoolClassController */
/* @var $model SchoolClass */

$this->breadcrumbs=array(
	'School Class'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('school-class-grid', {
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
<div class="module width_3_quarter">
		<div class="header">
			<h3 class="tabs_involved">View School Class</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'school-class-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'class_name',
		array(
			'header'=>'Grade Name',
			'name'=>'grade_id_fk',
			'value'=>'$data->gradeIdFk->grade_name',
		),
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'updateButtonImageUrl'=> Yii::app()->baseUrl.'/images/update.png',
			'deleteButtonImageUrl'=> Yii::app()->baseUrl.'/images/delete.png'
		),
	),
)); ?>
</div>