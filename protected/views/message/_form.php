<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */


Yii::app()->clientScript->registerScript(
   'validateMessageForm',
   '
  
	$("#slQueryType").change(function(){
		if($(this).val()==="Admin"){
			if($("#txtMailTo").val()==""){
				$("#txtMailTo").val("Admin, ");
			}
			else{
				$("#txtMailTo").val($("#txtMailTo").val()+"Admin, ");
			}
		}
	});
	
	$("#message-form").submit(function(e){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>";
		$("#validationMessage").html("");
		if($("#txtMailTo").val()==""){
			validate=false;
			message+="To field can not be blank.<br/>";
		}
		if($("#txtSubject").val()==""){
			validate=false;
			message+="Subject can not be blank.<br/>";
		}
		if($("#txtMessage").val()==""){
			validate=false;
			message+="Message can not be blank.<br/>";
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

	<div id="validationMessage" style="display:none;" class="alert_warning"></div>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset class="merge-control-row">
	<label>To <span class="required">*</span> </label>
	<select id="slQueryType">
		<option>Select</option>
		<option>Admin</option>
		<option>School</option>
		<option>Teacher</option>
		<option>Player</option>
		<option>Sponsor</option>
	</select>
	<?php
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			//'model'=>$model,
			//'attribute'=>'name',
			'id'=>'txtMailTo',
			'name'=>'Message[to]',
			'source'=>"js:function(request, response) {
				$.getJSON('".$this->createUrl('Message/getAllList')."', {
					term: extractLast(request.term), qt :$('#slQueryType').val()
				}, response);
			}",
			'options'=>array(
				'delay'=>300,
				'minLength'=>2,
				'showAnim'=>'fold',
				'select'=>"js:function(event, ui) {
					var terms = split(this.value);
					terms.pop();
					terms.push( $('#slQueryType').val()+': '+ui.item.value +'('+ui.item.id+')' );
					terms.push('');
					this.value = terms.join(', ');
					return false;
				},
				focus: function (event, ui) {
					event.preventDefault();
					return false;
				}"
			),
			'htmlOptions'=>array(
				'size'=>'40',
				'autofocus'=>'true'
			),
		));
	?>
	</fieldset>

	<fieldset>
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>200,'id'=>'txtSubject')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</fieldset>
	
	<fieldset>
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('size'=>60,'maxlength'=>1000,'id'=>'txtMessage')); ?>
		<?php echo $form->error($model,'message'); ?>
	</fieldset>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save'); ?>
		<input type="reset" value="Cancel"/>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->