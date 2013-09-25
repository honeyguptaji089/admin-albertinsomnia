<?php
/* @var $this GameLevelController */
/* @var $model GameLevel */
/* @var $form CActiveForm */
$gameLevelName="input[name='GameLevel[cards][]']";
$gameLevelFunction="input[name='GameLevel[functions][]']";
Yii::app()->clientScript->registerScript(
   'validateSponsorUpdateForm',
   '$("#btnCheck").click(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>";
			
			$("#validationMessage").html("");
		if($("#txtGameLevel").val()==""){
			validate=false;
			message+="Game Level Name can not be blank.<br/>";
		}
		if($("#GameLevel_total_targets").val()=="" || isNaN($("#GameLevel_total_targets").val())){
			validate=false;
			message+="Game Target should be a number.<br/>";
		}
		
		
		if(validate)
		{
			var cardsData="",functionsData="";
			$("#GameLevel_cards input[type=checkbox]:checked").each(function() {
				cardsData+=$(this).val()+",";
			});
			cardsData=cardsData.slice(0,-1);
			$("#GameLevel_functions input[type=checkbox]:checked").each(function() {
				functionsData+=$(this).val()+",";
			});
			functionsData=functionsData.slice(0,-1);
			//var combinedData=cardsData.toString()+"A"+functionsData.toString();
			var basicURL="'.Yii::app()->createUrl("GameLevel/Target").'&cards="+cardsData.toString()+"&functions="+functionsData.replace("+","p").toString();
			$.ajax({
			  url: basicURL,
			  type: "post",
			  success: function(data){
				  if(data==="null"){
						alert("Your Selected Cards and Function Pattern not found in Database. Try to Choose diiferent Set of Cards and Functions");
				  }
				  else{
					var givenTarget=parseInt($("#GameLevel_total_targets").val());
					var dbTarget=parseInt(data);
					if(dbTarget>givenTarget){
						var result=confirm("Max target for Current Set of Cards and Function in Database is "+dbTarget+" Would you like to Choose Database max Target value");
						if(result){
							$("#GameLevel_total_targets").val(dbTarget).attr("readonly","true");
							$("#actual-footer").removeClass("hidden");
							$("#fake-footer").addClass("hidden");
						}
						else{
							$("#GameLevel_total_targets").attr("readonly","true");
							$("#actual-footer").removeClass("hidden");	
							$("#fake-footer").addClass("hidden");
						}
					}
					else if(dbTarget==givenTarget){
						var result=confirm("Wow! Your Selected Cards Pattern, Function Pattern and Max Target exactly match with Database Records");
						if(result){
							$("#txtTTarget").val(dbTarget).attr("readonly","true");
							$("#actual-footer").removeClass("hidden");
							$("#fake-footer").addClass("hidden");
						}
					}
					else{
						var result=confirm("Max target for Current Set of Cards and Function in Database is "+dbTarget+" You have to Choose Database max Target value");
						if(result){
							$("#GameLevel_total_targets").val(dbTarget).attr("readonly","true");
							$("#actual-footer").removeClass("hidden");
							$("#fake-footer").addClass("hidden");
						}
					}
					
				  }
			  },
			  error:function(ts){
				   console.log(ts.responseText);
			  }   
			});
			return false;	
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
	'id'=>'game-level-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

<div class="module_content">
	<div id="validationMessage" style="display:none;" class="alert_warning">
	</div>
<div class="form">


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="left">
		<?php echo $form->labelEx($model,'level_name'); ?>
		<?php echo $form->textField($model,'level_name',array('size'=>45,'maxlength'=>45,'autofocus'=>'true')); ?>
		<?php echo $form->error($model,'level_name'); ?>
	</fieldset>
	
	<fieldset class="right">
		<?php echo $form->labelEx($model,'total_targets'); ?>
		<?php echo $form->textField($model,'total_targets'); ?>
		<?php echo $form->error($model,'total_targets'); ?>
	</fieldset>
	
	<fieldset class="left checklist" id="GameLevel_cards">
		<label>cards <span class="required">*</span></label>
		<?php
		
			foreach($this->cards as $key=>$value){
				if($value==='true'){
					echo "<input type='checkbox' name='GameLevel[cards][]' checked='checked' value='".($key+1)."'><label>Card ".($key+1)."</label><br/>";
				}
				else if($value==='false')
				{
					echo "<input type='checkbox' name='GameLevel[cards][]' value='".($key+1)."'><label>Card ".($key+1)."</label><br/>";
				}
			}
		?>
		<?php echo $form->error($model,'cards'); ?>
	</fieldset>
	
	<fieldset class="right checklist" id="GameLevel_functions">
		<label>functions <span class="required">*</span></label>
		<?php
		
			foreach($this->functions as $key=>$value){
				if($value==='true'){
					echo "<input type='checkbox' name='GameLevel[functions][]' checked='checked' value='".$key."'><label>".$key."</label><br/>";
				}
				else if($value==='false')
				{
					echo "<input type='checkbox' name='GameLevel[functions][]' value='".$key."'><label>".$key."</label><br/>";
				}
			}
		?>
		<?php echo $form->error($model,'functions'); ?>
	</fieldset>
	
	<div class="clear"></div>

		
		


</div>
<div class="footer hidden" id="actual-footer">
	<div class="submit_link">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<input type="reset" value="Cancel"/>
	</div>
</div>
<div class="footer" id="fake-footer">
	<input type="button" value="Check Data" id="btnCheck"></div>
</div>
</div>
<?php $this->endWidget(); ?>
