<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '$("#advertisement-form").submit(function(){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>",
		urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
		$("#validationMessage").html("");
		if($("#txtAdName").val()==""){
			validate=false;
			message+="Advertisement Name can not be blank<br/>";
		}
		if($("#txtAdDes").val()==""){
			validate=false;
			message+="Advertisement Description can not be blank<br/>";
		}
		if($("#txtAdNavURL").val()==""){
			validate=false;
			message+="Advertisement URL can not be blank<br/>";
		}
		if(!urlregex.test($("#txtAdNavURL").val())){
			validate=false;
			message+="Advertisement URL should be valid.<br/>";
		}
		if($("#slAdPosition").val()==="Select Position"){
			validate=false;
			message+="Select Advertisement Position<br/>";
		}
		
		if(validate)
		{
			return true;
		}	
		else
		{
			$("#validationMessage").show().append(message);
			return false;
		}
		
   });',
   CClientScript::POS_READY
);


?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 


	$sponsor=Sponsor::model();
?>
<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
	<div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="right">
		<?php echo $form->labelEx($model,'ad_name'); ?>
		<?php echo $form->textField($model,'ad_name',array('size'=>50,'maxlength'=>50,'id'=>'txtAdName','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'ad_name'); ?>
	</fieldset>
	<fieldset class="left">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('maxlength'=>500,'id'=>'txtAdDes')); ?>
		<?php echo $form->error($model,'description'); ?>
	</fieldset>

	<fieldset class="right long">
		<?php echo $form->labelEx($model,'navigation_url'); ?>
		<?php echo $form->textField($model,'navigation_url',array('size'=>60,'maxlength'=>200,'id'=>'txtAdNavURL')); ?>
		<?php echo $form->error($model,'navigation_url'); ?>
	</fieldset>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo CHtml::activeDropDownList($model, 'position', array('Select Position'=>'Select Position','Top'=>'Top','Right'=>'Right','Bottom'=>'Bottom','Left'=>'Left'),array('id'=>'slAdPosition'));  ?>
		<?php echo $form->error($model,'position'); ?>
	</fieldset>
	<div class="clear"></div>




</div>	
	<div class="footer">
		<div class="submit_link">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>