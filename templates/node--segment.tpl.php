<?php

/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */


if($field_full_width_image) {
	$full = strip_tags( $field_full_width_image[0]['value'] );
} else {
	$full=0;
}
//dpm($field_featurette_image);

$fid = $field_featurette_image[0]['fid']; 
//$path = file_create_url(file_load($fid)->uri);
$variables = array(
        'style_name' => 'featurette',
        'path' => file_load($fid)->uri,
        'attributes' => array('class' => 'img-responsive'),
);
//$img = '<img class="featurette-image img-responsive" src="'.$path.'" />';
$img = theme( 'image_style', $variables );

//image full with style
$variables = array(
        'style_name' => 'segment_full_width_image',
        'path' => $field_featurette_image[0]['uri'],
        'attributes' => array('class' => 'img-responsive'),
);
$img_full = theme( 'image_style', $variables );
//$img_full = '<img class="img-responsive" src="'.$path.'" />';

$values = field_get_items('node', $node, 'field_image_position');
if ($values != FALSE) {
  $positionval = $values[0]['value'];
}
else {
  $positionval='right';// no result
}

/* get title animation */
$valanim = field_get_items('node', $node, 'field_title_animation');
$animation = $valanim[0]['value'];



?>

<?php if(!$full) { ?>
<div class="row <?php print theme_get_setting('base_layout');?> featurette center-block">
        <div class="featurette-image-div-right col-xs-12 col-sm-7 col-md-7 <?php if( $positionval=='left' ) { print 'col-sm-push-5 col-md-push-5';} ?> cell-vertical-center">
          <h2 class="featurette-heading wow <?php print $animation ?>"><?php print $title ?> <span class="text-muted"><?php print $field_secondary_title[0]['value'] ?></span></h2>
          <div class="featurette-body wow fadeIn" data-wow-delay="0.5s"><p class="lead"><?php print $body[0]['value'] ?></p></div>
        </div>
        <div class="featurette-image-div-left wow fadeInLeft col-xs-12 ol-sm-5 col-md-5 <?php if( $positionval=='left' ) { print 'coll-sm-pull-7 col-md-pull-7';} ?>">
          <?php print $img; ?>
        </div>
</div>
<?php } else  { ?>

<div class="visible-xs row <?php print theme_get_setting('base_layout');?> featurette center-block">
        <div class="featurette-image-div-right col-xs-12 col-sm-7 col-md-7 <?php if( $positionval=='left' ) { print 'col-sm-push-5 col-md-push-5';} ?> cell-vertical-center">
          <h2 class="featurette-heading wow <?php print $animation ?>"><?php print $title ?> <span class="text-muted"><?php print $field_secondary_title[0]['value'] ?></span></h2>
          <div class="featurette-body wow fadeIn" data-wow-delay="0.5s"><p class="lead"><?php print $body[0]['value'] ?></p></div>
        </div>
        <div class="featurette-image-div-left wow fadeInLeft col-xs-12 ol-sm-5 col-md-5 <?php if( $positionval=='left' ) { print 'coll-sm-pull-7 col-md-pull-7';} ?>">
        <?php print $img_full ?>      
        </div>
</div>



<div class="hidden-xs carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="item active">
      <?php print $img_full ?>      
      <div class="carousel-caption">
        <h1 class="field-content wow <?php print $animation ?>"><?php print $title ?></h1>
          <div class="lead hidden-xs field-content wow wow <?php print $animation ?>" data-wow-delay="0.5s">
            <h3><?php 
              if( $field_secondary_title ) {
                  print $field_secondary_title[0]['value'] ;
                }//end if
            ?></h3>
              <div class="featurette-body wow fadeIn" data-wow-delay="0.5s"><p class="lead"><?php print $body[0]['value'] ?></p></div>
          </div>
      </div>
    </div>

  </div>

</div>

<?php } //end if-else
?>








