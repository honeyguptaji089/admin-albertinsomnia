<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validateAdvertisementForm',
   '$(".rdImageOption").change(function(obj){
		$("#divWebURL, #divCompURL").hide();
		if(parseInt(this.value)===0){
			$("#divWebURL").show();
		}
		else{
			$("#divCompURL").show();
		}
	});
	$("#advertisement-form").submit(function(){
		var validate=true,message="<b>Solve all the input errors:</b><br/><br/>",
		adFile=$("#AdFile").val(),
		adfileExt=adFile.substring(adFile.lastIndexOf('.') + 1).toLowerCase();
		$("#validationMessage").html("");
		
		if($(".rdImageOption:checked").length<1){
			validate=false;
			message+="Please Select option for adding Advertisement Image<br/>";
		}
		if(parseInt($(".rdImageOption:checked").val())===0){
			if($("#txtImageURL").val()==""){
				validate=false;
				message+="Write Advertisement Image URL<br/>";
			}
			if(($("#txtImageURL").val()!="")&&(!imageUrlRegex.test($("#txtImageURL").val()))){
				validate=false;
				message+="Advertisement Image URL should be valid.<br/>";
			}
		}
		if(parseInt($(".rdImageOption:checked").val())===1){
			if($("#AdFile").val()===""){
				validate=false;
				message+="Select Advertisement Image File<br/>";
			}
			if(adfileExt=="jpg"||adfileExt=="gif"||adfileExt=="png"){
				validate=false;
				message+="Select valid Advertisement Image File<br/>";
			}
			
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

	<fieldset>
		<label>Image Url <span class="required">*</span></label>
		<label style="clear:both;">
			<input type="radio" name="Advertisement[ad_img_type]" class="rdImageOption" value="0" autofocus='true'/>From URL &nbsp;&nbsp;
			<input type="radio" name="Advertisement[ad_img_type]" class="rdImageOption" value="1" />From Computer
		</label>
		<div id="divWebURL">
			<input type="text" name='txtImageURL' size="60" maxlength="200" id='txtImageURL'/>
		</div>
		<div id="divCompURL" style="clear:both;">
			<?php echo $form->fileField($model, 'image_url',array('id'=>'AdFile')); ?>
			<label style="width:100%;">Accepted Image Format (.jpg, .jpeg, .gif, .png)</label>
			<?php echo $form->error($model,'image_url'); ?>
		</div>
	
	

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
