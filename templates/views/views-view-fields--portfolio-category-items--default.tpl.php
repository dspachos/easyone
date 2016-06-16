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

          	$fileid = $fields['field_image']->content; 
          	$path = file_load($fileid)->uri;


            $variables = array('style_name' => 'portfolio_item',
                   'path' => $path,
                   'attributes' => array('class' => 'img-responsive'),
                   );
                   $img = theme( 'image_style', $variables );

?>

<?php
	$fid = explode(',', $fields['field_categories']->content);
?>

  <div class="col-xs-12 col-sm-6 col-md-3 text-center view-tenth hidden-xs hidden-sm">
    	  <?php print $img; ?>
                    <div class="mask">
                        <h3><?php print strip_tags($fields['title']->content); ?></h3>
                        <br />
                        <p class="overlay-text">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        <br />
                       <a href="#" data-toggle="modal" data-target="#myModal-<?php print $view->row_index.'-'.$fid[0]; ?>"><i class="fi-magnifying-glass"></i></a>
                    </div>
  </div>


<div class="visible-xs thumbnail">
<a href="#" data-toggle="modal" data-target="#myModal-<?php print $view->row_index.'-'.$fid[0]; ?>"> 
        <?php print $img; ?>
        <div class="wrapper">
          <div class="caption post-content">
          <h3><?php print strip_tags($fields['title']->content); ?></h3>
          </div>
        </div>
</a>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal-<?php print $view->row_index.'-'.$fid[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php print strip_tags($fields['title']->content); ?></h4>
      </div>
      <div class="modal-body">
		<p class="text-justify"><?php print $fields['body']->content; ?></p>

		<p><?php print $fields['field_url']->content; ?></p>

        <blockquote>
          <p><?php print $fields['field_client_testimonials']->content; ?></p>
          <footer><?php print $fields['field_testimonials_from']->content; ?><cite><?php print strip_tags($fields['title']->content); ?></cite></footer>
        </blockquote>

	</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>