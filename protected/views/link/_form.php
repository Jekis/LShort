<?php
/* @var $this LinkController */
/* @var $model Link */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'link-form',
	'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'afterValidate'=>'js:afterValidateAjaxSubmit',
    ),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'url'); ?>
		<?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Shorten URL'); ?>
	</div>

<?php $this->endWidget(); ?>

    <script type="text/javascript">
        function afterValidateAjaxSubmit(form, data, hasError) {
            var resultContainer = $('#shorten-url');
            if (!hasError) {
                // Submit form.
                $.ajax({
                    type: 'POST',
                    url: form.action,
                    dataType: 'html',
                    data: form.serialize(),
                    success: function(data) {
                        form.find(':input').closest('div').removeClass('success');
                        form.get(0).reset();
                        resultContainer.html(data);
                    },
                    error: function(data) {
                        alert("Error occurred, please try again");
                    }
                });
            } else {
                resultContainer.html('');
            }
        }
    </script>
</div><!-- form -->
