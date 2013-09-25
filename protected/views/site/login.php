<script type="text/javascript">
	
	createTimeZoneCookie();
	function createTimeZoneCookie(){
		if(document.cookie.indexOf("YIITZ")<0){
			var d = new Date(),
			offset= (-d.getTimezoneOffset()/60).toString();
			var pieces = offset.split("."),
			hours =  pieces[0],
			minutes='', result='';
			if (pieces.length == 1)
			{
				minutes = 0;
			}
			else
			{  
				minutes = '.' + pieces[1];
			}
			// convert .5 to 30  
			minutes *= 60; 

			if (hours[0] == '-')
			{
				minutes = '-' + minutes;
			}
			
			result= hours + ' hours ' + minutes + ' minutes';
			if( result.indexOf('-')<0 ){
				result= '*'+hours + ' hours *' + minutes + ' minutes';
			}
			document.cookie="YIITZ=" + result;
		}
	}
</script>
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>




<div class="login_module">
	<div class="header">
		<h3>Login</h3>
	</div>
	<div class="login_content">
		<p>Please fill out the following form with your login credentials:</p>
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>



			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<fieldset>
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</fieldset>

			<fieldset>
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
			</fieldset>
			
			<div class="row rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Login'); ?>
				<input type="reset" value="Cancel"/>
			</div>

		<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
	
</div>