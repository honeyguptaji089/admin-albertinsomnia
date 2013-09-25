<?php
/* @var $this SponsorController */
/* @var $model Sponsor */
/* @var $form CActiveForm */

 Yii::app()->clientScript->registerScript(
   'validateSponsorUpdateForm',
   '$("#sponsor-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>",
			email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		if($("#txtSponsorName").val()==""){
			validate=false;
			message+="Sponsor Name can not be blank.<br/>";
		}
		/*
		if($("#txtSponsorAddress").val()==""){
			validate=false;
			message+="Sponsor Address can not be blank.<br/>";
		}
		if($("#txtSponsorPhone").val()==""){
			validate=false;
			message+="Sponsor Phone can not be blank.<br/>";
		}
		*/
		if($("#txtSponsorEmail").val()==""){
			validate=false;
			message+="Sponsor Email can not be blank.<br/>";
		}
		if(($("#txtSponsorEmail").val()!="") && (!email_exp.test($("#txtSponsorEmail").val()))){
			validate=false;
			message+="Sponsor Email is not valid.<br/>";
		}
		if($("#txtSponsorPassword").val()==""){
			validate=false;
			message+="Sponsor Password can not be blank.<br/>";
		}
		if($("#txtSponsorConfirmPassword").val()==""){
			validate=false;
			message+="Confrim Password field can not be blank.<br/>";
		}
		if($("#txtSponsorPassword").val()!==$("#txtSponsorConfirmPassword").val()){
			validate=false;
			message+="Confrim Password not match with Password.<br/>";
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
		'id'=>'sponsor-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
	));
	$modelUserInfo=new UserInfo;
	?>
		<div class="module_content">
		<div id="validationMessage" style="display:none;" class="alert_warning">
		</div>	
		
		<div class="form">


			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<fieldset class="left long">
				<?php echo $form->labelEx($model,'sponsor_name'); ?>
				<?php echo $form->textField($model,'sponsor_name',array('size'=>45,'maxlength'=>45,'width'=>'92%','id'=>'txtSponsorName','autofocus'=>'true')); ?>
				<?php echo $form->error($model,'sponsor_name'); ?>
			</fieldset>
			<fieldset class="right">
				<?php echo $form->labelEx($model,'sponsor_address'); ?>
				<?php echo $form->textArea($model,'sponsor_address',array('size'=>45,'maxlength'=>45,'id'=>'txtSponsorAddress')); ?>
				<?php echo $form->error($model,'sponsor_address'); ?>
			</fieldset>

			<fieldset class="left">
				<?php echo $form->labelEx($model,'sponsor_phone'); ?>
				<?php echo $form->textField($model,'sponsor_phone',array('size'=>45,'maxlength'=>45,'id'=>'txtSponsorPhone')); ?>
				<?php echo $form->error($model,'sponsor_phone'); ?>
			</fieldset>
			<fieldset class="right">
				<?php echo $form->labelEx($modelUserInfo,'email'); ?>
				<?php echo $form->textField($modelUserInfo,'email',array('size'=>45,'maxlength'=>45,'id'=>'txtSponsorEmail')); ?>
				<?php echo $form->error($modelUserInfo,'email'); ?>
			</fieldset>
			
			<fieldset class="left">
				<?php echo $form->labelEx($modelUserInfo,'password'); ?>
				<?php echo $form->passwordField($modelUserInfo,'password',array('size'=>45,'maxlength'=>45,'id'=>'txtSponsorPassword')); ?>
				<?php echo $form->error($modelUserInfo,'password'); ?>
			</fieldset>
			<fieldset  class="right">
				<label>CONFIRM PASSWORD <span class="required">*</span></label>
				<input type="password" name="confirm_pwd" id="txtSponsorConfirmPassword"/>
			</fieldset>
			<fieldset class="left">
				<label>Sponsor Code</label>
				<?php echo $form->textField($model,'sponsor_code',array('size'=>45,'maxlength'=>45,'readonly'=>'true','value'=>$this->sponsor_code)); ?>
				<?php echo $form->error($model,'sponsor_code'); ?>
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
	</div>
<?php $this->endWidget(); ?>
	