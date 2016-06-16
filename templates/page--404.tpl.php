<?php
/**
 * @file
 * @ingroup themeable
 */
?>
<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="<?php print theme_get_setting('base_layout');?>">
    <div class="navbar-header">
      <?php if ($logo): ?>
      <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
      <?php endif; ?>

      <?php if (!empty($site_name)): ?>
      <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      <?php endif; ?>

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php 
            //print render($primary_nav); 
            $main_menu_tree = menu_tree_all_data('main-menu');
            $main_menu_expanded = menu_tree_output($main_menu_tree);
            $mm = render($main_menu_expanded);
            $mm = str_replace('<ul class="menu nav"', '<ul class="nav navbar-nav navbar-right"', $mm);
            print $mm;

            ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php //print render($secondary_nav); 
            ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
      </div>
    <?php endif; ?>
  </div>
</header>

<?php 
if ( theme_get_setting('bootstrap_navbar_position')=='fixed-top') {
 $extra=' move-down-container '; 
} else {$extra='';}//end if
?>

<div class="main-container <?php print $extra;?> <?php print theme_get_setting('base_layout');?>">


  <header role="banner" id="page-header">
    <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#page-header -->

<div class="row">

    <section<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>


      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print theme_get_setting('e1custom404_title', 'easyone') ?></h1>
      <?php endif; ?>

      <div class="text-center">
        <p class="page-404-subtitle"><?php print theme_get_setting('e1custom404_subtitle', 'easyone') ?></p>
      </div>

      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>

      <div class="c404 text-center">404 error</div>


       <div class="center-block" style="width:324px"><?php
          $block = module_invoke('search', 'block_view', 'search');
          print render($block);
          ?></div>

    </section>
</div>
</div>
