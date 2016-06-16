<?php
/**
 * @file
 * template-settings.php
 */


function easyone_form_system_theme_settings_alter(&$form, $form_state) {

  global $base_url;
  $theme_path = $base_url .'/'. drupal_get_path('theme', 'easyone');
// drupal_set_message("<pre>".print_r($form,TRUE)."</pre>");


  // Unset default Bootstrap themes settings
  unset($form['bootstrap']);
  unset($form['components']);
  unset($form['javascript']);
  unset($form['advanced']);


  $form['easyfour'] = array(
    '#type' => 'vertical_tabs',
    '#prefix' => '<h2><small>' . t('EasyOne Settings') . '</small></h2>',
    '#weight' => -100,
  );

  $form['e1general'] = array(
    '#type' => 'fieldset',
    '#title' => t('General'),
    '#group' => 'easyfour',
  );

  $form['e1general']['base_layout'] = array(
    '#type'          => 'radios',
    '#title'         => t('Please select'),
    '#default_value' => theme_get_setting('base_layout'),
    '#options'       => array(
            'container' => 'Fixed-width layout',
            'container-fluid' => 'Full-width layout',
           ),
    '#description' => 'Grid systems are used for creating page layouts through a series of rows and columns that house your content.',
  );

$form['e1general']['fluid_padding'] = array(
  '#type' => 'textfield',
  '#title' => t('Padding left-right'),
    '#size' => 4,
    '#attributes' => array('style'=>'width: 88px;'),
  '#default_value' => theme_get_setting('fluid_padding'),
  '#element_validate' => array('element_validate_integer'), 
  '#description' => 'Value (in pixels) for the left and right padding when fluid layout is selected. Does not affect boxed layout.',
);


/*
  $form['e1fonticons'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font icons'),
    '#group' => 'easyfour',
  );

  $form['e1fonticons']['use_foundation_icons'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Zurb Foundation Icons 3'),
    '#default_value' => theme_get_setting('use_foundation_icons'),
    '#description' => t('A custom collection of 283 icons that are stored in a handy web font. <a href="http://zurb.com/playground/foundation-icon-fonts-3">More..</a>.'),
  );


  $form['e1fonticons']['use_fontawesome_icons'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Font Awesome icons'),
    '#default_value' => theme_get_setting('use_fontawesome_icons'),
    '#description' => t('Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.. <a href="http://fortawesome.github.io/Font-Awesome/">More..</a>.'),
  );

*/

  $form['e1colorscheme'] = array(
    '#type' => 'fieldset',
    '#title' => t('Color schemes/themes'),
    '#group' => 'easyfour',
  );


  $form['e1colorscheme']['base_color_scheme_radiochoice'] = array(
    '#type'          => 'radios',
    '#title'         => t('Please select'),
    '#default_value' => theme_get_setting('base_color_scheme_radiochoice'),
    '#options'       => array(
            'default' => 'Use default theme',
            'bootswatch' => 'Use Bootswatch theme',
            'builtin' => 'Use custom color built-in scheme',
            'custom' => 'Use custom color scheme',
           ),
  );

  $form['e1colorscheme']['bootswatch_f'] = array(
    '#type' => 'fieldset',
    '#title' => t('Bootswatch theme'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#states' => array(
                'visible' => array(
                ':input[name="base_color_scheme_radiochoice"]' => array('value' => 'bootswatch'),
                  ),
                ),
  );

  $form['e1colorscheme']['bootswatch_f']['base_color_scheme_bootswatch'] = array(
    '#type'          => 'select',
    '#title'         => t('Color schemes/themes'),
    '#default_value' => theme_get_setting('base_color_scheme_bootswatch'),
    '#options'       => array(
            'http://bootswatch.com/amelia/bootstrap.min.css' => 'Amelia',
            'http://bootswatch.com/cerulean/bootstrap.min.css' => 'Cerulean',
            'http://bootswatch.com/cosmo/bootstrap.min.css' => 'Cosmo',
            'http://bootswatch.com/cyborg/bootstrap.min.css' => 'Cyborg',
            'http://bootswatch.com/darkly/bootstrap.min.css' => 'Darkly',
            'http://bootswatch.com/flatly/bootstrap.min.css' => 'Flatly',
            'http://bootswatch.com/journal/bootstrap.min.css' => 'Journal',
            'http://bootswatch.com/lumen/bootstrap.min.css' => 'Lumen',
            'http://bootswatch.com/readable/bootstrap.min.css' => 'Readable',
            'http://bootswatch.com/simplex/bootstrap.min.css' => 'Simplex',
            'http://bootswatch.com/slate/bootstrap.min.css' => 'Slate',
            'http://bootswatch.com/spacelab/bootstrap.min.css' => 'Spacelab',
            'http://bootswatch.com/superhero/bootstrap.min.css' => 'Superhero',
            'http://bootswatch.com/united/bootstrap.min.css' => 'United',
            'http://bootswatch.com/yeti/bootstrap.min.css' => 'Yeti',
           ),
    '#prefix' => t('<i>Original themes from <a href="http://bootswatch.com/">Bootswatch</a></i>'),
    '#suffix' => '<p><div id="theme_preview"></div></p>',
    '#ajax' => array(
      'callback' => 'theme_choice_js',
      'wrapper' => 'theme_preview',
      'method' => 'replace',
    ),
  );



  $form['e1colorscheme']['builtin_f'] = array(
    '#type' => 'fieldset',
    '#title' => t('Built-in color schemes'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#states' => array(
                'visible' => array(
                ':input[name="base_color_scheme_radiochoice"]' => array('value' => 'builtin'),
                  ),
                ),
  );

  $form['e1colorscheme']['builtin_f']['base_color_scheme_builtin'] = array(
    '#type'          => 'select',
    '#title'         => t('Color schemes/themes'),
    '#default_value' => theme_get_setting('base_color_scheme_builtin'),
    '#options'       => array(
            '/dark_light/bootstrap.min.css' => 'Dark light',
            '/dark_rise/bootstrap.min.css' => 'Dark rise',
            '/darky/bootstrap.min.css' => 'Darky',
            '/dark_stone/bootstrap.min.css' => 'Dark stone',
            '/dark_contrast/bootstrap.min.css' => 'Dark contrast',
            '/dark_cool/bootstrap.min.css' => 'Dark cool',
            '/darky_down/bootstrap.min.css' => 'Darky dawn',
            '/gray_wolf/bootstrap.min.css' => 'Gray wolf',
            '/aqua_rise/bootstrap.min.css' => 'Aqua rise',
            '/colors_pure/bootstrap.min.css' => 'Colors pure',
            '/red_stone/bootstrap.min.css' => 'Red stone',
            '/white_grass/bootstrap.min.css' => 'White grass',
            '/yellow_sub/bootstrap.min.css' => 'Yellow sub',
            '/green_only/bootstrap.min.css' => 'Green only',
            '/white_zen/bootstrap.min.css' => 'White zen',
            '/arc_light/bootstrap.min.css' => 'Arc light',
           ),
    '#suffix' => '<p><div id="theme_preview"></div></p>',
/*    '#ajax' => array(
      'callback' => 'theme_choice_js',
      'wrapper' => 'theme_preview',
      'method' => 'replace',
    ),*/
  );


  $src = $theme_path.'/icons/bootstrap.min.css.fw.png';
  $form['e1colorscheme']['custom_colorscheme']['ccs_markup'] = array(
    '#type' => 'item',
    '#markup' => '<p>Replace <code>easyone/bootstrap/css/bootstrap.min.css</code> with your custom Bootstrap css file, minified if possible.</p><p><img src="'.$src.'" /></p>',
    '#states' => array(
                'visible' => array(
                ':input[name="base_color_scheme_radiochoice"]' => array('value' => 'custom'),
                  ),
                ),
  );





  $form['e1navigation'] = array(
    '#type' => 'fieldset',
    '#title' => t('Navigation'),
    '#group' => 'easyfour',
  );

  $form['e1navigation']['bootstrap_navbar_position'] = array(
    '#type' => 'select',
    '#title' => t('Navbar Position'),
    '#description' => t('Select your Navbar position.'),
    '#default_value' => theme_get_setting('bootstrap_navbar_position'),
    '#options' => array(
      'static-top' => t('Static Top'),
      'fixed-top' => t('Fixed Top (theme default)'),
      'fixed-bottom' => t('Fixed Bottom'),
    ),
    '#empty_option' => t('Normal'),
   '#description' => '<p>&nbsp;</p><div style="float:left;margin-right:32px;"><img src="'.($theme_path.'/icons/navbar/nav-default.png').'"" /><h5>Default</h5></div><div style="float:left;margin-right:32px;"><img src="'.($theme_path.'/icons/navbar/nav-static-top.png').'"" /><h5>Static top</h5></div><div style="float:left;margin-right:32px;"><img src="'.($theme_path.'/icons/navbar/nav-fixed-top.png').'"" /><h5>Fixed top</h5></div><div style="float:left;margin-right:32px;"><img src="'.($theme_path.'/icons/navbar/nav-fixed-bottom.png').'"" /><h5>Fixed bottom</h5></div>',
  );


  $form['e1basefont'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font'),
    '#group' => 'easyfour',
  );

  $form['e1basefont']['base_font_family'] = array(
    '#type'          => 'select',
    '#title'         => t('Base font family'),
    '#default_value' => theme_get_setting('base_font_family'),
    '#options'       => array(
                      'font-family-none' => t('None - set manually in stylesheet'),
//                      'Open+Sans'=> '<div>'.' <img align="abs-middle" src="'.$theme_path.'/icons/fonts/opensans.png" /></div>',
                      'Open+Sans' => 'Open Sans',
                      'Ubuntu' => 'Ubuntu',
                      'Roboto' => 'Roboto',
                      'Oswald' => 'Oswald',
                      'Droid+Sans' => 'Droid Sans',
                      'Raleway' => 'Raleway',
                      'Arimo' => 'Arimo',
                      'Open+Sans+Condensed:300'=> 'Open Sans Condensed',
                      ),
    '#suffix' => 'Select a font for preview<div id="font_preview"></div>',
    '#ajax' => array(
      'callback' => 'font_choice_js',
      'wrapper' => 'font_preview',
      'method' => 'replace',
    ),
  );

  // Breadcrumbs.
  $form['e1basefont']['base_custom_font_fieldset'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom font'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['e1basefont']['base_custom_font_fieldset']['base_font_custom'] = array(
    '#type' => 'textfield',
    '#title' => t('Font name'),
    '#size' => 60,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#description' => 'e.g. Nova Script <p>CSS and styles will be added automatically.</p></p><p><font style="color:red">Attention: The font name must be a valid Google Font name, otherwise the default serif font will be used.</font></p>',
    '#default_value' => theme_get_setting('base_font_custom'),
  );


  $form['e1basefont']['base_font_size'] = array(
    '#type'          => 'select',
    '#title'         => t('Font Size'),
    '#default_value' => theme_get_setting('base_font_size'),
    '#options'       => array(
      '11px' => t('11px'),
      '12px' => t('12px - theme default'),
      '13px' => t('13px'),
      '14px' => t('14px'),
      '15px' => t('15px'),
      '16px' => t('16px'),
      ),
  );



  $form['e1footer'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer'),
    '#group' => 'easyfour',
  );

  $form['e1footer']['base_footer_theme'] = array(
    '#type'          => 'select',
    '#title'         => t('Base footer theme'),
    '#default_value' => theme_get_setting('base_footer_theme'),
    '#options'       => array(
                      'bg-default' => 'Default',
                      'bg-primary' => 'Primary',
                      'bg-success' => 'Success',
                      'bg-info' => 'Info',
                      'bg-warning' => 'Warning',
                      'bg-danger' => 'Danger',
                      ),
    '#description' => '<i>Footer themes are based on current selected theme</i>'
   );








  $form['e1blockstheme'] = array(
    '#type' => 'fieldset',
    '#title' => t('Blocks'),
    '#group' => 'easyfour',
  );

  $form['e1blockstheme']['base_block_theme_firstsidebar'] = array(
    '#type'          => 'select',
    '#title'         => t('Base block theme (sidebar first)'),
    '#default_value' => theme_get_setting('base_block_theme_firstsidebar'),
    '#options'       => array(
                      'default' => 'Default',
                      'primary' => 'Primary',
                      'success' => 'Success',
                      'info' => 'Info',
                      'warning' => 'Warning',
                      'danger' => 'Danger',
                      ),
    '#description' => '<i>Block themes are based on current selected theme</i>'
   );

  $form['e1blockstheme']['base_block_theme_secondsidebar'] = array(
    '#type'          => 'select',
    '#title'         => t('Base block theme (sidebar second)'),
    '#default_value' => theme_get_setting('base_block_theme_secondsidebar'),
    '#options'       => array(
                      'default' => 'Default',
                      'primary' => 'Primary',
                      'success' => 'Success',
                      'info' => 'Info',
                      'warning' => 'Warning',
                      'danger' => 'Danger',
                      ),
    '#description' => '<i>Block themes are based on current selected theme</i>'
   );




  $form['e1breadcrumb'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb'),
    '#group' => 'easyfour',
  );


  $form['e1breadcrumb']['breadcrumbs']['bootstrap_breadcrumb'] = array(
    '#type' => 'select',
    '#title' => t('Breadcrumb visibility'),
    '#default_value' => theme_get_setting('bootstrap_breadcrumb'),
    '#options' => array(
      0 => t('Hidden'),
      1 => t('Visible'),
      2 => t('Only in admin areas'),
    ),
  );
  $form['e1breadcrumb']['breadcrumbs']['bootstrap_breadcrumb_home'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show "Home" breadcrumb link'),
    '#default_value' => theme_get_setting('bootstrap_breadcrumb_home'),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is enabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );

  $form['e1breadcrumb']['breadcrumbs']['bootstrap_breadcrumb_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show current page title at end'),
    '#default_value' => theme_get_setting('bootstrap_breadcrumb_title'),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is disabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );



/*  if(module_exists('easyone_map')) {
      $form['e1map'] = array(
        '#type' => 'fieldset',
        '#title' => t('Map'),
        '#group' => 'easyfour',
      );
  }//end if
*/

  $form['e1contact'] = array(
    '#type' => 'fieldset',
    '#title' => t('Contact information'),
    '#group' => 'easyfour',
  );

  $form['e1contact']['e1contact_markup'] = array(
    '#type' => 'item',
    '#markup' => t("Contact information can be used from EasyOne Contact module."),
  );


  $form['e1contact']['e1contact_addr_title'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Address title'),
    '#description' => t("e.g. Twitter, Inc."),
    '#default_value' => theme_get_setting('e1contact_addr_title'),
  );

  $form['e1contact']['e1contact_addr_ln1'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Line 1'),
    '#description' => t("e.g. 795 Folsom Ave, Suite 600"),
    '#default_value' => theme_get_setting('e1contact_addr_ln1'),
  );

  $form['e1contact']['e1contact_addr_ln2'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Line 2'),
    '#description' => t("e.g. San Francisco, CA 94107"),
    '#default_value' => theme_get_setting('e1contact_addr_ln2'),
  );

  $form['e1contact']['e1contact_tel'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Telephone'),
    '#description' => t("e.g. (123) 456-7890"),
    '#default_value' => theme_get_setting('e1contact_tel'),
  );

  $form['e1contact']['e1contact_fax'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Fax'),
    '#description' => t("e.g. (123) 456-7891"),
    '#default_value' => theme_get_setting('e1contact_fax'),
  );

  $form['e1contact']['e1contact_person'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Contact person full name'),
    '#description' => t("e.g. Tim Cook"),
    '#default_value' => theme_get_setting('e1contact_person'),
  );

  $form['e1contact']['e1contact_person_email'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Contact person full name'),
    '#description' => t("e.g. timcook@twitter.com"),
    '#default_value' => theme_get_setting('e1contact_person_email'),
  );

  $form['e1contact']['e1contact_other'] = array(
    '#type' => 'textarea',
    '#resizable' => TRUE,
    '#rows' => 5,
    '#title' => t('Other contact information'),
    '#description' => t("Allowed HTML tags: a em strong p cite blockquote code ul ol li dl dt dd"),
    '#default_value' => theme_get_setting('e1contact_other'),
  );



  $form['e1custom404'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom 404 error page'),
    '#group' => 'easyfour',
  );

  $form['e1custom404']['e1custom404_markup'] = array(
    '#type' => 'item',
    '#markup' => t("Custom 404 error page."),
  );

  $form['e1custom404']['e1custom404_title'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
//    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('404 error page title'),
    '#description' => t("e.g. Oops, This Page Could Not Be Found!"),
    '#default_value' => theme_get_setting('e1custom404_title'),
  );

  $form['e1custom404']['e1custom404_subtitle'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
//    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('404 error page subtitle'),
    '#description' => t("e.g. We're sorry, but the page you were looking for doesn't exist."),
    '#default_value' => theme_get_setting('e1custom404_subtitle'),
  );




  $form['e1social'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social media'),
    '#group' => 'easyfour',
  );

  $form['e1social']['social_markup'] = array(
    '#type' => 'item',
    '#markup' => t("Social media fieds can be used from EasyOne Social module."),
  );



  $form['e1social']['social_fb'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Facebook URL'),
//    '#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/fb.png" />',
    '#description' => t("e.g. https://www.facebook.com/acme"),
    '#default_value' => theme_get_setting('social_fb'),
//    '#prefix' => '<div style="float:left; margin-right: 48px;">',
//    '#suffix' => '</div>',
  );

  $form['e1social']['social_twitter'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Twitter URL'),
  //  '#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/twitter.png" />',
    '#description' => t("e.g. https://twitter.com/acme"),
    '#default_value' => theme_get_setting('social_twitter'),
 //   '#prefix' => '<div style="float:left;">',
 //   '#suffix' => '</div>',
  );

  $form['e1social']['social_gplus'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Google+ URL'),
    //'#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/gplus.png" />',
    '#description' => t("e.g. https://twitter.com/acme"),
    '#default_value' => theme_get_setting('social_gplus'),
//    '#prefix' => '<div style="float:left; margin-right: 48px;">',
//    '#suffix' => '</div>',
  );

  $form['e1social']['social_youtube'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('YouTube URL'),
    //'#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/youtube.png" />',
    '#description' => t("e.g. https://youtube.com/acme"),
    '#default_value' => theme_get_setting('social_youtube'),
//    '#prefix' => '<div style="float:left;">',
//    '#suffix' => '</div>',
  );

  $form['e1social']['social_linkedin'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('LinkedIn URL'),
    //'#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/linkedin.png" />',
    '#description' => t("e.g. http://www.linkedin.com/in/acme"),
    '#default_value' => theme_get_setting('social_linkedin'),
//    '#prefix' => '<div style="float:left; margin-right: 48px;">',
//    '#suffix' => '</div>',
  );

  $form['e1social']['social_instagram'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Instagram URL'),
    //'#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/instagram.png" />',
    '#description' => t("e.g. http://instagram.com/acme"),
    '#default_value' => theme_get_setting('social_instagram'),
//    '#prefix' => '<div style="float:left;">',
//    '#suffix' => '</div>',
  );


  $form['e1social']['social_pinterest'] = array(
    '#type' => 'textfield',
    '#size' => 80,
    '#maxlength' => 255,
    '#attributes' => array('style'=>'width: 324px;'),
    '#title' => t('Pintertest URL'),
    //'#field_suffix' => '<img style="vertical-align: bottom" src="'.$theme_path.'/icons/social/pintertest.png" />',
    '#description' => t("e.g. http://www.pinterest.com/acme"),
    '#default_value' => theme_get_setting('social_pinterest'),
//    '#prefix' => '<div style="float:left;">',
//    '#suffix' => '</div>',
  );




  $form['e1circlestats'] = array(
    '#type' => 'fieldset',
    '#title' => t('Circle stats'),
    '#group' => 'easyfour',
  );

  $form['e1circlestats']['e1circlestats_markup'] = array(
    '#type' => 'item',
    '#markup' => t("Circle stats values can be used with EasyOne Circle Stats module. You can define up to 4 circle stats elements."),
  );


  $form['e1circlestats']['cs_style'] = array(
    '#type' => 'checkbox',
    '#title' => t('Circle stats as full circles'),
    '#default_value' => theme_get_setting('cs_style'),
  );


  $form['e1circlestats']['cs1'] = array(
    '#type' => 'fieldset',
    '#title' => t('Circle stat #1'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#attributes' => array('style'=>'float: left;'),
  );

  $form['e1circlestats']['cs1']['cs1_value'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Percent value'),
    '#description' => t("e.g. 50"),
    '#default_value' => theme_get_setting('cs1_value'),
  );

  $form['e1circlestats']['cs1']['cs1_label'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 50,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Label'),
    '#description' => t("e.g. HTML5"),
    '#default_value' => theme_get_setting('cs1_label'),
  );

  $form['e1circlestats']['cs1']['cs1_color'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Color in HEX format'),
    '#description' => t("e.g. 1E90FE"),
    '#default_value' => theme_get_setting('cs1_color'),
  );


  $form['e1circlestats']['cs2'] = array(
    '#type' => 'fieldset',
    '#title' => t('Circle stat #2'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#attributes' => array('style'=>'float: left;'),
  );

  $form['e1circlestats']['cs2']['cs2_value'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Percent value'),
    '#description' => t("e.g. 50"),
    '#default_value' => theme_get_setting('cs2_value'),
  );

  $form['e1circlestats']['cs2']['cs2_label'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 50,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Label'),
    '#description' => t("e.g. HTML5"),
    '#default_value' => theme_get_setting('cs2_label'),
  );

  $form['e1circlestats']['cs2']['cs2_color'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Color in HEX format'),
    '#description' => t("e.g. 1E90FE"),
    '#default_value' => theme_get_setting('cs2_color'),
  );


  $form['e1circlestats']['cs3'] = array(
    '#type' => 'fieldset',
    '#title' => t('Circle stat #2'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#attributes' => array('style'=>'float: left;'),
  );


  $form['e1circlestats']['cs3']['cs3_value'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Percent value'),
    '#description' => t("e.g. 50"),
    '#default_value' => theme_get_setting('cs3_value'),
  );

  $form['e1circlestats']['cs3']['cs3_label'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 50,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Label'),
    '#description' => t("e.g. HTML5"),
    '#default_value' => theme_get_setting('cs3_label'),
  );

  $form['e1circlestats']['cs3']['cs3_color'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Color in HEX format'),
    '#description' => t("e.g. 1E90FE"),
    '#default_value' => theme_get_setting('cs3_color'),
  );


  $form['e1circlestats']['cs4'] = array(
    '#type' => 'fieldset',
    '#title' => t('Circle stat #2'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#attributes' => array('style'=>'float: left;'),
  );


  $form['e1circlestats']['cs4']['cs4_value'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Percent value'),
    '#description' => t("e.g. 50"),
    '#default_value' => theme_get_setting('cs4_value'),
  );

  $form['e1circlestats']['cs4']['cs4_label'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 50,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Label'),
    '#description' => t("e.g. HTML5"),
    '#default_value' => theme_get_setting('cs4_label'),
  );

  $form['e1circlestats']['cs4']['cs4_color'] = array(
    '#type' => 'textfield',
    '#size' => 20,
    '#maxlength' => 10,
    '#attributes' => array('style'=>'width: 124px;'),
    '#title' => t('Color in HEX format'),
    '#description' => t("e.g. 1E90FE"),
    '#default_value' => theme_get_setting('cs4_color'),
  );



}//end function



function theme_choice_js($form, $form_state) {
  $val = $form_state['values']['base_color_scheme_bootswatch'];
  $val = str_replace('bootstrap.min.css', 'thumbnail.png', $val);
  $str = '<div style="float: right" id="theme_preview"><img width="50%" src="'.$val.'" /></div>';

  return $str;
}



function font_choice_js($form, $form_state) {

  global $base_url;
  $theme_path = $base_url .'/'. drupal_get_path('theme', 'easyone');

  $val = $form_state['values']['base_font_family'];
  $url = $theme_path.'/scripts/font-preview?fontname='.$val;
  $str = '<div style="width: 100%; clear: both;" id="font_preview"><p>Preview (12px): </p><iframe style="width:100%; height: 224px" src='.$url.'></iframe></div>';
  return $str;
}








/* eof */




