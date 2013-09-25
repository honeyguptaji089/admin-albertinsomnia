<?php
/* @var $this SchoolController */
/* @var $model School */

$user_type=intVal(Yii::app()->user->user_type);

if($user_type===2){
	$this->breadcrumbs=array();
}
else{
	$this->breadcrumbs=array(
		'Schools'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);

}

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'View School', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage School', 'url'=>array('admin')),
);


if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
	
?>
<div class="module width_full">

	<div class="header">
	  <h3>Update School Admin</h3>
	</div>
	<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>