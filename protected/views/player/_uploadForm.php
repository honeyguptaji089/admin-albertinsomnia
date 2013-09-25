<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePlayerForm',
   '$("#player-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>",
			email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		if($("#txtPlayerName").val()==""){
			validate=false;
			message+="Player Name can not be blank.<br/>";
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
	'id'=>'player-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 
?>
<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
<div class="form">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<fieldset class="left">
		<label>GRADE <span class="required">*</span></label>
		<?php echo  CHtml::activeDropDownList($model,'player_grade_id_fk',$this->grade,
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('player/Class'),
														'update'=>'#slClass',
														'data'=>array('school_grade'=>'js:$(this).val()')
													),
													'id'=>'slGrade',
													'name'=>'Player[Grade]',
													'autofocus'=>'true'
												)); ?>
	</fieldset>
	
	<fieldset class="right">
		<label>CLASS <span class="required">*</span></label>
		<?php echo CHtml::dropDownList('Player[player_class_id_fk]','', array(),array('id'=>'slClass')) ?>
	</fieldset>
	
	<fieldset class="left">
			<?php echo $form->labelEx($model,'player_file'); ?>
			<?php echo $form->fileField($model, 'player_file',array('id'=>'flPlayer')); ?>
			<span>Select only <b>.xls</b> File</span>
	</fieldset>
		
	<div class="clear"></div>
	
	<?php if(isset($this->importStatus)){?>
		<table style="width:100%;">
			<tr>
				<th>Upload Player Status</th>
			</tr>	
			<?php foreach($this->importStatus as $status){ ?>
			<tr>
				<td
					<?php
					if($status[1]=="success"){
						echo "style='background:#00FF00;color:#FFF;border: 1px solid #000;'";
					}
					else if($status[1]=="fail"){ 
						echo "style='background:#FF0000;color:#FFF;border: 1px solid #000;'";
					}?>
					
				>
					<?php echo $status[0]; ?>
					
				</td>
			<tr>
			<?php } ?>
		</table>
	<?php } ?>
	<div>
		<p>Please refer below format for the data:<br/></p>
		<p>* Insure that email field value should not be Hyperlink:<br/></p>
		<img src="images/player_upload.png"/>
	</div>

	



</div><!-- form -->

<div class="footer">
	<div class="submit_link">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('value'=>'Upload')); ?>
		<input type="reset" value="Cancel"/>
	</div>
</div>

</div>
<?php $this->endWidget(); ?>
