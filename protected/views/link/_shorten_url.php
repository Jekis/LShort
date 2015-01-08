<?php
/* @var $this LinkController */
/* @var $link Link */
?>

<?php if ($link): ?>
    <?php $absoluteUrl = $this->createAbsoluteUrl('/'. $link->shortCode); ?>
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
            <td><?php echo $link->url; ?></td>
            <td><?php echo CHtml::link($absoluteUrl, $absoluteUrl) ?></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>
