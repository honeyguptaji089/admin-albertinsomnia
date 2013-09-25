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
			totalCards=0,
			totalFunctions=0,
			haveFactorial=false,
			message="<b>Solve all the input errors:</b><br/><br/>";
			$("#GameLevel_functions input:checkbox").each(function(){
				if(this.checked)
				{
					totalFunctions++;
					if($(this).val()==="!")
					haveFactorial=true;
				}
			});
			$("#GameLevel_cards input:checkbox").each(function(){
				if(this.checked)
					totalCards++;
			});
			$("#validationMessage").html("");
		if($("#txtGameLevel").val()==""){
			validate=false;
			message+="Game Level Name can not be blank.<br/>";
		}
		if (totalCards < 2) {
			validate=false;
			message+="Minimum two Card needs to be Selected.<br/>";
		}
		if (totalCards > 6) {
			validate=false;
			message+="Maximum Six Card needs to be Selected.<br/>";
		}
		if (totalFunctions < 1) {
			validate=false;
			message+="Minimum one Function needs to be Selected.<br/>";
		}	
		if(!haveFactorial && totalFunctions>totalCards){
			validate=false;
			message+="Number of Functions should be less than number of Cards.<br/>";
		}
		if(haveFactorial && totalFunctions>totalCards){
			validate=false;
			message+="Number of Functions in Levels should be less than or equal to Cards.<br/>";
		}
		if(($("#txtTTarget").val()=="" ) && !isNaN($("#txtTTarget").val())){
			validate=false;
			message+="Total targets should be a number.<br/>";
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
					var givenTarget=parseInt($("#txtTTarget").val());
					var dbTarget=parseInt(data);
					if(dbTarget>givenTarget){
						var result=confirm("Max target for Current Set of Cards and Function in Database is "+dbTarget+" Would you like to Choose Database max Target value");
						if(result){
							$("#txtTTarget").val(dbTarget).attr("readonly","true");
							$("#actual-footer").removeClass("hidden");
							$("#fake-footer").addClass("hidden");
						}
						else{
							$("#txtTTarget").attr("readonly","true");
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
							$("#txtTTarget").val(dbTarget).attr("readonly","true");
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
		
   });
   function getData(){
		 
   }
   $("input[value=Create]").click(function(){
	getData();
   });
   ',
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
		<?php echo $form->textField($model,'level_name',array('size'=>45,'maxlength'=>45,'id'=>'txtGameLevel','autofocus'=>'true')); ?>
		<?php echo $form->error($model,'level_name'); ?>
	</fieldset>
	
	<fieldset class="right checklist">
		<label>Cards <span class="required">*</span></label>
		<?php echo $form->CheckBoxList($model,'cards', $this->cards); ?>
		<?php echo $form->error($model,'cards'); ?>
	</fieldset>
	
	<fieldset class="left checklist">
		<label>functions <span class="required">*</span></label>
		<?php echo $form->CheckBoxList($model,'functions', $this->functions); ?>
		<?php echo $form->error($model,'functions'); ?>
	</fieldset>
	<fieldset class="left">
		<label>Total Targets <span class="required">*</span></label>
		<?php echo $form->textField($model,'total_targets',array('size'=>45,'maxlength'=>45,'id'=>'txtTTarget')); ?>
		<?php echo $form->error($model,'total_targets'); ?>
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
<?php $this->endWidget(); ?>