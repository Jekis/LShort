<?php
/* @var $this LinkController */
/* @var $formModel Link */
/* @var $createdModel Link */

$this->breadcrumbs = array();
$this->menu = array(
    array('label' => 'Shorten new URL', 'url' => array('/')),
);
?>

<?php $this->renderPartial('_form', array('model' => $formModel)); ?>

<div id="shorten-url">
    <?php $this->renderPartial('_shorten_url', array('link' => $createdModel)); ?>
</div>
