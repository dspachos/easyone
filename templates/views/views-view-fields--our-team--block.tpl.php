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
?>
<div class="col-xs-12 col-sm-6 col-md-3 text-center user-cell">
<!--<img alt="140x140" src="http://placehold.it/140x140" style="width: 180px; height: 180px;"> //-->

<div class="wow flipInY" data-wow-delay="<?php print ($view->row_index)/3 ?>s"><?php print $fields['picture']->content ?></div>

<div itemscope itemtype="http://schema.org/Person">
          <h2>
          	<span itemprop="name"><?php print strip_tags( $fields['field_first_name']->content ) ?> <?php print strip_tags( $fields['field_last_name']->content ) ?></span>
      	  </h2>
      	  <h3>
      	  	<font class="user-title"><span itemprop="jobTitle"><?php print $fields['field_user_title']->content ?></span></font>
			</h3>
          <p class="text-justify user-bio">
            <?php print substr( strip_tags( $fields['field_bio']->content),0,255 ).'...' ?>
		  </p>
			          <a href="#" data-toggle="modal" data-target="#myModal-<?php print strip_tags($fields['uid']->content) ?>" class="btn btn-default"><?php print t('Full bio'); ?></a>
		
		  <div class="user-cell-links">
		  	<a href="<?php print $fields['field_facebook_url']->content ?>"><i class="text-primary fi-social-facebook fa-3x fb"></i></a>
		  	<a href="<?php print $fields['field_twitter_url']->content ?>"><i class="text-primary fi-social-twitter fa-3x tw"></i></a>
		  	<a href="<?php print $fields['field_google_url']->content ?>"><i class="text-primary fi-social-google-plus fa-3x gp"></i></a>
		  	<a href="mailto:<?php print $fields['field_contact_email']->content ?>" itemprop="email"><i class="text-primary fi-mail fa-3x ml"></i></a>
		  </div>

</div> <!-- end microdata //-->

</div>


<!-- Modal -->
<div class="modal fade" id="myModal-<?php print strip_tags($fields['uid']->content) ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				<div class="modal-profile-picture-thumbnail"><a href="#" class="thumbnail"><?php print $fields['picture_1']->content ?></a></div>
        <h2 class="modal-title" id="myModalLabel"><?php print strip_tags($fields['field_first_name']->content).' '. strip_tags($fields['field_last_name']->content) ?></h2>
	      	  <h3>
    	  	  	<font class="user-title"><?php print $fields['field_user_title']->content ?></font>
				</h3>
      </div>
      <div class="modal-body">

		<p class="text-justify"><?php print $fields['field_bio']->content; ?></p>

		  <div class="user-cell-links">
		  	<a href="<?php print $fields['field_facebook_url']->content ?>"><i class="text-primary fi-social-facebook fa-3x fb"></i></a>
		  	<a href="<?php print $fields['field_twitter_url']->content ?>"><i class="text-primary fi-social-twitter fa-3x tw"></i></a>
		  	<a href="<?php print $fields['field_google_url']->content ?>"><i class="text-primary fi-social-google-plus fa-3x gp"></i></a>
		  	<a href="mailto:<?php print $fields['field_contact_email']->content ?>" itemprop="email"><i class="text-primary fi-mail fa-3x ml"></i></a>
		  </div>
		  

	</div>



      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>














