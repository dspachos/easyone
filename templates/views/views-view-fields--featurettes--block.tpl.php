<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

$effect="wow fadeInRightBig";
if( ($view->row_index%2)==0 ) {
  $effect="wow fadeInLeftBig";
}//end if


?>

<?php if( $view->row_index>0 ) { ?>
<!-- <hr class="featurette-divider"> //-->
<p>&nbsp;</p>
<?php } ?>

<div class="row featurette center-block">
        <div class="col-sm-7 col-md-7 <?php if( ($view->row_index%2)==0 ) { print 'col-md-push-5';} ?> cell-vertical-center">
          <h2 class="featurette-heading"><?php print $fields['title']->content; ?><span class="text-muted"><?php print $fields['field_secondary_title']->content; ?></span></h2>
          <p class="lead"><?php print $fields['body']->content; ?></p>
        </div>
        <div class="col-sm-5 col-md-5 <?php if( ($view->row_index%2)==0 ) { print 'col-md-pull-7';} ?>">
          <?php 
          	$fid = $fields['field_featurette_image']->content; 
          	$path = file_create_url(file_load($fid)->uri);
			print '<img class="featurette-image img-responsive '.$effect.'" src="'.$path.'" />';
          ?>
        </div>
</div>