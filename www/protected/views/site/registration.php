<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>

<?php else: ?>

<?php
/* @var $this RegistrationController */
/* @var $model Registration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'registration-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'login'); ?>
        <?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    
    <?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Реєстрація'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>