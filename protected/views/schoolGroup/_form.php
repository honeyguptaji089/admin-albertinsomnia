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
		<input type="checkbox" name="SchoolGroup[is_competition_group]" id="chIsCompetition"/>
	</fieldset>

	
	<fieldset class="right">
		<?php echo $form->labelEx($model,'group_name'); ?>
		<?php echo $form->textField($model,'group_name',array('size'=>60,'maxlength'=>100,'id'=>'txtGroupName','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'group_name'); ?>
	</fieldset>
	
	<fieldset class="left">
		<?php echo $form->labelEx($model,'school_grade'); ?>
		<?php echo CHtml::activeDropDownList($model,
												'school_grade',
												$this->schoolGrades,
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('competition/Class'),
														'update'=>'#slClass',
														'data'=>array('school_grade'=>'js:$(this).val()')
													),
													'id'=>'slGrade',
													'name'=>'SchoolGroup[SchoolGrade]'
													
													
												)
											); 
		?>
		<?php echo $form->error($model,'school_grade'); ?>
	</fieldset>
	
	<fieldset class="right">
		<label>School Class <span class="required">*</span></label>
		<?php echo CHtml::activeDropDownList($model,
												'school_class',
												array(),
												array(
													'ajax' => array(
														'type'=>'POST',
														'url'=>CController::createUrl('SchoolGroup/Player'),
														'update'=>'#slPlayer',
														'data'=>array('school_class'=>'js:$(this).val()')
													),
													'id'=>'slClass',
													'name'=>'SchoolGroup[SchoolClass]'
													
													
												)
											); 
		?>
	</fieldset>
	<fieldset >
		<label>School Player <span class="required">*</span></label>
		<?php echo CHtml::dropDownList('SchoolGroup[player][]','', array(),array('id'=>'slPlayer','multiple'=>true)) ?>
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
