<?php
/* @var $this TeacherController */
/* @var $model Teacher */


if(intVal(Yii::app()->user->user_type)===4){
	$this->breadcrumbs=array();
}
else{

	$this->breadcrumbs=array(
		'School Groups'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
}
?>

<div class="module width_full">
	<div class="header">
	  <h3>Update Teacher</h3>
	</div>
	<?php
		if(isset($_GET['message'])&&intVal($_GET['message'])){
			echo "<div class='".$this->message_type."'>".$this->message."</div>";
		}
	?>
<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>