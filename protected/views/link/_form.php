<?php
/* @var $this LinkController */
/* @var $model Link */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'link-form',
	'enableAjaxValidation' => true,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Shorten URL'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
