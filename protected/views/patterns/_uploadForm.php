<?php
/* @var $this PatternsController */
/* @var $model Patterns */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePatternForm',
   '$("#patterns-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		if($("#txtCards").val()==""){
			validate=false;
			message+="Enter Card Sequence.<br/>";
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
	'id'=>'patterns-upload-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	

<div class="form">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
		<label>Select Pattern File<span class="required">*</span> :</label>
		<?php echo $form->fileField($model, 'pattern_file',array('id'=>'flPattern')); ?>
		<span>Select only <b>.xls</b> File</span>
	
	</fieldset>
	

	<div class="clear"></div>
	<?php if(!isset($this->importStatus)){?>
		<p>Refer below Image for Pattern Data</p>
		<p>* There should be a Header in Pattern file like below.</p>
		<p>* Cards should be in sorting order (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12) if possible.</p>
		<p>* Functions should be in following order (+, -, X, /, ^, !) if possible.</p>
		<img src="images/pattern_upload.jpg"/>
	<?php }?>
	<?php if(isset($this->importStatus)){?>
		<table style="width:100%;">
			<tr>
				<th>Pattern Upload Status</th>
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
					}
					else if($status[1]=="warning"){ 
						echo "style='background:#CCA300;color:#000;border: 1px solid #000;'";
					}
					?>
					
				>
					<?php echo $status[0]; ?>
					
				</td>
			<tr>
			<?php } ?>
		</table>
	<?php } ?>
	
</div>
<div class="footer">
	<div class="submit_link">
		<?php echo CHtml::submitButton('Upload'); ?>
		<input type="reset" value="Cancel"/>
	</div>
</div>
</div>
<?php $this->endWidget(); ?>
