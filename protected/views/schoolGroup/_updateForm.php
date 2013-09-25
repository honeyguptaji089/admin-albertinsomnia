<?php
/* @var $this SchoolGroupController */
/* @var $model SchoolGroup */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '
  
		$("#btnDeleteGroupInfo").click(function(){
			 var playerCount=$("#player-info .player").length;
			if(playerCount>1){
				$("#player-info .player:last").remove();
				var counterVal=parseInt($("#hdCounter").val())-1;
				$("#hdCounter").val(counterVal);
			}
		});
		
	$("#school-group-form").submit(function(e){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		var groupSelectID="slGroup",adSelectID="slAdvertisement";
		if($("#txtGroupName").val()==""){
			validate=false;
			message+="Group Name can not be blank.<br/>";
		}
		if($("#slClass").val()===null || $("#slClass").val()=="Select Class"){
			validate=false;
			message+="Select School Class.<br/>";
		}
		if($("#slPlayer").val()===null || $("#slPlayer").val().length<1){
			message+="Select at least one Player.<br/>";
			validate=false;
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
		
	});
	
	
   ',
   CClientScript::POS_READY
);



?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-group-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>	
	
	<div class="form">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<fieldset class="left" style="height:45px;">
		<label>FOR COMPETITION GROUP </label>
		<input type="checkbox" name="SchoolGroup[is_competition_group]" id="chIsCompetition" autofocus='true'/>
	</fieldset>

	
	<fieldset class="right">
		<?php echo $form->labelEx($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>60,'maxlength'=>100,'id'=>'txtGroupName')); ?>
		<?php echo $form->error($model,'group_name'); ?>
	</fieldset>
	
	<fieldset class="left">
		<?php echo $form->labelEx($model,'school_grade'); ?>
		<?php echo $this->schoolGrades;?>
		<?php echo $form->error($model,'school_grade'); ?>
	</fieldset>
	
	<fieldset class="right">
		<label>School Class <span class="required">*</span></label>
		<?php echo $this->schoolClass;?>
	</fieldset>
	<fieldset >
		<label>School Player <span class="required">*</span></label>
		<?php echo $this->player; ?>
	</fieldset>

	<div class="clear"></div>


</div><!-- form -->
	<div class="footer">
		<div class="submit_link">
		 <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'btnSubmit')); ?>
		 <input type="reset" value="Cancel"/>
		</div>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
	
	$('body').on('change','#slGrade',function(){jQuery.ajax({'type':'POST','url':'/game_portal/index.php?r=competition/Class','data':{'school_grade':$(this).val()},'cache':false,'success':function(html){jQuery("#slClass").html(html)}});return false;});
	$('body').on('change','#slClass',function(){jQuery.ajax({'type':'POST','url':'/game_portal/index.php?r=schoolgroup/Player','data':{'school_class':$(this).val()},'cache':false,'success':function(html){jQuery("#slPlayer").html(html)}});return false;});

</script>
