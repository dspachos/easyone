<?php

/**
 * @file
 * template.php
 */



function easyone_css_alter(&$css) {
  $theme_path = drupal_get_path('theme', 'easyone');
  // Exclude specified CSS files from theme.

    $base_color_scheme = theme_get_setting('base_color_scheme_radiochoice');

    if( $base_color_scheme=='default' ) {
          $bootstrap_min = $theme_path . '/bootstrap/css/bootstrap.min.css';
          $css[$bootstrap_min] = array(
            'data' => $bootstrap_min,
            'type' => 'file',
            'every_page' => TRUE,
            'media' => 'all',
            'preprocess' => TRUE,
            'group' => CSS_THEME,
            'browsers' => array('IE' => TRUE, '!IE' => TRUE),
            'weight' => 1010,
          );
        } //end if


    if( $base_color_scheme=='builtin' ) {
          $bootstrap_min = $theme_path .'/css/color-schemes'. theme_get_setting('base_color_scheme_builtin');
          $css[$bootstrap_min] = array(
            'data' => $bootstrap_min,
            'type' => 'file',
            'every_page' => TRUE,
            'media' => 'all',
            'preprocess' => TRUE,
            'group' => CSS_THEME,
            'browsers' => array('IE' => TRUE, '!IE' => TRUE),
            'weight' => 1010,
          );
        }//end if



        if( $base_color_scheme=='bootswatch' ) {
            $bootstrap_min = theme_get_setting('base_color_scheme_bootswatch');
            $css[$bootstrap_min] = array(
            'data' => $bootstrap_min,
            'type' => 'external',
            'every_page' => TRUE,
            'media' => 'all',
            'preprocess' => TRUE,
            'group' => CSS_THEME,
            'browsers' => array('IE' => TRUE, '!IE' => TRUE),
            'weight' => 1010,
          );
      }//end if

    $custom = $theme_path . '/css/easyone.css';
    $css[$custom] = array(
      'data' => $custom,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => 1030,
    );


    $custom = $theme_path . '/css/custom.css';
    $css[$custom] = array(
      'data' => $custom,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => 1030,
    );

    if(theme_get_setting('use_foundation_icons', 'easyone')) {
    $found_icons = $theme_path . '/fonts/foundation-icons/foundation-icons.css';
    $css[$found_icons] = array(
      'data' => $found_icons,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => 1040,
    );
  }//end if

    if(theme_get_setting('use_fontawesome_icons', 'easyone')) {
    $fontawesome = $theme_path. '/fonts/font-awesome/css/font-awesome.min.css';
    $css[$fontawesome] = array(
      'data' => $fontawesome,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => 1050,
    );
  }//end if



  /* prism */
      $custom = $theme_path . '/prism/prism.css';
      $css[$custom] = array(
      'data' => $custom,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => 1099,
    );







}//end function css alter



function easyone_js_alter(&$js) {
  $theme_path = drupal_get_path('theme', 'easyone');

    $js_file = $theme_path . '/bootstrap/js/bootstrap.min.js';
    $js[$js_file] = drupal_js_defaults();
    $js[$js_file]['data'] = $js_file;
    $js[$js_file]['type'] = 'file';
    $js[$js_file]['every_page'] = TRUE;
    $js[$js_file]['weight'] = 1002;


   $js_file = $theme_path . '/scripts/jquery.classymap.min.js';
    $js[$js_file] = drupal_js_defaults();
    $js[$js_file]['data'] = $js_file;
    $js[$js_file]['type'] = 'file';
    $js[$js_file]['every_page'] = TRUE;
    $js[$js_file]['weight'] = 1002;




   $js_file = $theme_path . '/prism/prism.js';
    $js[$js_file] = drupal_js_defaults();
    $js[$js_file]['data'] = $js_file;
    $js[$js_file]['type'] = 'file';
    $js[$js_file]['every_page'] = TRUE;
    $js[$js_file]['weight'] = 1099;


/*  // add inline javascript
  drupal_add_js("
    jQuery(document).ready(function() {
        jQuery('.carousel').carousel();
    });
  ", 'inline');
*/


/*    $js_file_scrolly = $theme_path . '/scripts/jquery.scrolly.js';
    $js[$js_file_scrolly] = drupal_js_defaults();
    $js[$js_file_scrolly]['data'] = $js_file_scrolly;
    $js[$js_file_scrolly]['type'] = 'file';
    $js[$js_file_scrolly]['every_page'] = TRUE;
    $js[$js_file_scrolly]['weight'] = 1002;
*/

/*    $js_file_scrolly = $theme_path . '/scripts/jquery.parallax-1.1.3.js';
    $js[$js_file_scrolly] = drupal_js_defaults();
    $js[$js_file_scrolly]['data'] = $js_file_scrolly;
    $js[$js_file_scrolly]['type'] = 'file';
    $js[$js_file_scrolly]['every_page'] = TRUE;
    $js[$js_file_scrolly]['weight'] = 1002;
*/

}//end function js alter

 



function easyone_preprocess_page(&$vars) {

  $header = drupal_get_http_header("status");
  if($header == "404 Not Found") {
    $vars['theme_hook_suggestions'][] = 'page__404';
  }
  if($header == "403 Forbidden") {
    $vars['theme_hook_suggestions'][] = 'page__403';
  }

/* if(arg(0) == 'taxonomy' && arg(1) == 'term') {
        $tid = (int)arg(2);
        $term = taxonomy_term_load($tid);
        if(is_object($term)) {
           $vars['theme_hook_suggestions'][] = 'page__taxonomy__'.$term->vocabulary_machine_name;
        }//end if
  }//end if
*/
  
}//end function


function easyone_preprocess_html(&$variables) {
  $font = theme_get_setting('base_font_family');
  $font = str_replace('+', ' ', $font);

  $font_size = theme_get_setting('base_font_size');

  $font_custom = theme_get_setting('base_font_custom');
  $font_custom = str_replace('+', ' ', $font_custom);

  if($font_custom) {
    drupal_add_css('http://fonts.googleapis.com/css?family='.$font_custom.':300,400,500,700&subset=latin,greek', array('group' => CSS_THEME));
   $css = " *, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: '".$font_custom."', serif} body:not(#admin-menu){ font-size: ".$font_size." ;} ";

  } else {
    drupal_add_css('http://fonts.googleapis.com/css?family='.$font.':300,400,500,700&subset=latin,greek', array('group' => CSS_THEME));
   $css = " *, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: '".$font."', serif} body:not(#admin-menu){ font-size: ".$font_size." ;} ";
}


   drupal_add_css($css, array('group' => CSS_THEME, 'type' => 'inline', 'weight' => 1020));


      {//block
          $val = theme_get_setting('fluid_padding', 'easyone').'px';
          $css = '.container-fluid { padding-left:'.$val.'; padding-right:'.$val.';}';
         drupal_add_css($css, array('group' => CSS_THEME, 'type' => 'inline', 'weight' => 1031));
      }//end code block

}//end preprocess_html













