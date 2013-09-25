<?php
/* @var $this SponsorController */
/* @var $model Sponsor */

if(intVal(Yii::app()->user->user_type)==1){
	$this->breadcrumbs=array();
}
else{
	$this->breadcrumbs=array(
		'Sponsors'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);

}

if(isset($_GET['message'])&&intVal($_GET['message'])){
	echo "<div class='".$this->message_type."'>".$this->message."</div>";
}
?>


<div class="module width_full">

	<div class="header">
	  <h3>Update Sponsor</h3>
	</div>

	<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>
</div>