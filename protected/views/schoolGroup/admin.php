<?php
/* @var $this SchoolGroupController */
/* @var $model SchoolGroup */

$this->breadcrumbs=array(
	'School Groups'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('school-group-grid', {
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
			<h3 class="tabs_involved">View School Groups</h3>
			<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		</div>
		
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'school-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{pager}{items}{pager}',
	'cssFile'=>Yii::app()->baseUrl.'/css/girdViewStyle.css',
	'columns'=>array(
		'id',
		'group_name',
		array(
			'header'=>'Class',
			'name'=>'class_id_fk',
			'value'=>'$data->classIdFk->class_name'
		),
		array(
			'header'=>'Is Competition Group',
			'name'=>'is_competition_group',
			'value'=>'$data->getStatus($data->is_competition_group)'
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