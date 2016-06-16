<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <?php 

    global $base_url;
    $row = str_replace('href="', 'href="'.$base_url.'/', $row);
    print $row; ?>
<?php endforeach; ?>