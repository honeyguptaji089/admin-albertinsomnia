<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '$("#school-form").submit(function(){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>",
		email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		
		if($("#txtSchoolName").val()==""){
			validate=false;
			message+="School Name can not be blank<br/>";
		}
		if($("#txtEmail").val()==""){
			validate=false;
			message+="Email can not be blank<br/>";
		}
		if(!email_exp.test($("#txtEmail").val())){
			validate=false;
			message+="Email should be valid<br/>";
		}
		if($("#txtPassword").val()==""){
			validate=false;
			message+="Password can not be blank<br/>";
		}
		if($("#txtConfirmPassword").val()==""){
			validate=false;
			message+="Confirm Password can not be blank<br/>";
		}
		if($("#txtConfirmPassword").val()!==$("#txtPassword").val()){
			validate=false;
			message+="Confirm Password not matched with Password<br/>";
		}
		if($("#txtAddress").val()==""){
			validate=false;
			message+="Address can not be blank<br/>";
		}
		if($("#txtPhone").val()==""){
			validate=false;
			message+="Phone can not be blank<br/>";
		}
		if($("#txtPhone").val()!=="" && isNaN($("#txtPhone").val())){
			validate=false;
			message+="Phone Number should be numeric<br/>";
		}
		if($("#txtContact").val()==""){
			validate=false;
			message+="Contact Name can not be blank<br/>";
		}
		if($("#txtStudentNo").val()==""){
			validate=false;
			message+="Number of Student can not be blank<br/>";
		}
		if($("#txtStudentNo").val()!=="" && isNaN($("#txtStudentNo").val())){
			validate=false;
			message+="Number of Student should be numeric<br/>";
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); 
	$userinfoModel= new UserInfo;
?>
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
	

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'school_name'); ?>
		<?php echo $form->textField($model,'school_name',array('size'=>60,'maxlength'=>200,'id'=>'txtSchoolName','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'school_name'); ?>
	</fieldset>

	<fieldset class="right">
		<?php echo $form->labelEx($model,'school_code'); ?>
		<?php echo $form->textField($model,'school_code',array('size'=>10,'maxlength'=>10,'value'=>$this->school_code,'readonly'=>'true')); ?>
		<?php echo $form->error($model,'school_code'); ?>
	</fieldset>
	<fieldset class="left">
		<?php echo $form->labelEx($userinfoModel,'email'); ?>
		<?php echo $form->textField($userinfoModel,'email',array('size'=>60,'maxlength'=>500,'id'=>'txtEmail')); ?>
		<?php echo $form->error($userinfoModel,'email'); ?>
	</fieldset>
	<fieldset class="right">
		<?php echo $form->labelEx($userinfoModel,'password'); ?>
		<?php echo $form->passwordField($userinfoModel,'password',array('size'=>60,'maxlength'=>500,'id'=>'txtPassword')); ?>
		<?php echo $form->error($userinfoModel,'password'); ?>
	</fieldset>
	<fieldset class="left">
		<label>Re-Type Password <span class="required">*</span></label>
		<input type="password" id="txtConfirmPassword"/>
	</fieldset>

	<fieldset class="right">
		<?php echo $form->labelEx($model,'school_address'); ?>
		<?php echo $form->textField($model,'school_address',array('size'=>60,'maxlength'=>500,'id'=>'txtAddress')); ?>
		<?php echo $form->error($model,'school_address'); ?>
	</fieldset>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>45,'maxlength'=>45,'id'=>'txtPhone')); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</fieldset>

	<fieldset class="right">
		<label>Contact Name <span class="required">*</span></label>
		<?php echo $form->textField($model,'contact_name',array('size'=>60,'maxlength'=>100,'id'=>'txtContact')); ?>
		<?php echo $form->error($model,'contact_name'); ?>
	</fieldset>

	<fieldset class="left">
		<label>No of Students <span class="required">*</span></label>
		<?php echo $form->textField($model,'no_student',array('size'=>10,'maxlength'=>10,'id'=>'txtStudentNo')); ?>
		<?php echo $form->error($model,'no_student'); ?>
	</fieldset>

	<div class="clear"></div>

		


</div>
<div class="footer">
	<div class="submit_link">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
	</div>
</div>
<?php $this->endWidget(); ?>