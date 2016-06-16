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

?>
<?php if ($view_mode=='teaser') { ?>

<?php if ($title_prefix || $title_suffix || $display_submitted || !$page): ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="post">
                <div class="post-img-content">
                  <?php          
                            $images = field_get_items('node', $node, 'field_image');
                            if (count($images)>0) {
                            foreach($images as $img) {
                                $variables = array(
                                        'style_name' => 'blog_post',
                                        'path' => $img['uri'],
                                        'attributes' => array('class' => 'img-responsive wow flipInY', 'data-wow-delay'=>'0.5s'),
                                );
                                print theme( 'image_style', $variables );
                            }//end foreach
                          }//end if
                  ?>
                    <span class="post-title"><b><?php print $title; ?></b></span>
                </div>
                <div class="content">
                    <div class="author">
                        <?php print $submitted ?>
                        <!--<time datetime="2014-01-20">January 20th, 2014</time>//-->
                    </div>
                    <div>
                      <?php
                      print render(field_view_field('node', $node, 'body', array(
                        'label'=>'hidden',
                        'type' => 'text_summary_or_trimmed',
                        'settings'=>array('trim_length' => 255),
                      ))); 
                      ?>                   

                    </div>
                    <div>
                        <p><a href="<?php print $node_url ?>" class="btn btn-default btn-sm">Read more</a></p>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="modal-blog-post-<?php print $node->nid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php print $title; ?></h4>
        <div><?php print $submitted ?></div>
      </div>
      <div class="modal-body">
        <?php print render($content['body']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<?php 
   endif;
  }//end if teaser
?>


<?php if ($view_mode!=='teaser') { ?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php if ($display_submitted): ?>
      <div class="submitted well well-sm">
        <?php print $user_picture; ?>
        <span class="glyphicon glyphicon-calendar"></span> <?php print $submitted; ?>
      </div>
    <?php endif; ?>
  </header>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_tags']);
      hide($content['field_image']);
      hide($content['body']);

          $images = field_get_items('node', $node, 'field_image');
          $cls='12';
          $str='';
          if (count($images)>0) {
            $cls = "8";
          $str.= '<div class="col-md-4">';
          foreach($images as $img) {
            /* print image with style */
              $variables = array(
                      'style_name' => 'blog_post',
                      'path' => $img['uri'],
                      'attributes' => array('class' => 'img-responsive'),
              );
              $str .= '<div class="thumbnail">'.theme( 'image_style', $variables ).'</div>';
          }//end foreach
          $str.='</div>';
        }//end if
    ?>
      <div class="row">
        <div class="col-md-<?php print $cls?> blog-post-body"><?php print render($content['body']) ?>
          <?php print render($content); ?>
      </div>
          <?php print $str ?>
      </div>




  </div>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
    <?php print render($content['field_tags']); ?>
    <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>


<div class="row text-center"><?php
  $alias = url('blog');
  print "<a href='$alias'>Back to blog</a>";
?></div>


  <?php print render($content['comments']); ?>
</article>
<?php }//end if !teaser 
?>



