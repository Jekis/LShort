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

<?php if ($createdModel): ?>
    <?php $absoluteUrl = $this->createAbsoluteUrl('/'. $createdModel->shortCode); ?>
<h3>Get your short URL</h3>

<table>
    <thead>
    <tr>
        <th>Long URL</th>
        <th>Short URL</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $createdModel->url; ?></td>
        <td><?php echo CHtml::link($absoluteUrl, $absoluteUrl) ?></td>
    </tr>
    </tbody>
</table>
<?php endif; ?>
