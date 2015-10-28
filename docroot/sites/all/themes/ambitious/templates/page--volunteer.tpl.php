  <?php
  /**
  * @file
  * Bartik's theme implementation to display a single Drupal page.
  *
  * The doctype, html, head and body tags are not in this template. Instead they
  * can be found in the html.tpl.php template normally located in the
  * modules/system directory.
  *
  * Available variables:
  *
  * General utility variables:
  * - $base_path: The base URL path of the Drupal installation. At the very
  *   least, this will always default to /.
  * - $directory: The directory the template is located in, e.g. modules/system
  *   or themes/bartik.
  * - $is_front: TRUE if the current page is the front page.
  * - $logged_in: TRUE if the user is registered and signed in.
  * - $is_admin: TRUE if the user has permission to access administration pages.
  *
  * Site identity:
  * - $front_page: The URL of the front page. Use this instead of $base_path,
  *   when linking to the front page. This includes the language domain or
  *   prefix.
  * - $logo: The path to the logo image, as defined in theme configuration.
  * - $site_name: The name of the site, empty when display has been disabled
  *   in theme settings.
  * - $site_slogan: The slogan of the site, empty when display has been disabled
  *   in theme settings.
  * - $hide_site_name: TRUE if the site name has been toggled off on the theme
  *   settings page. If hidden, the "element-invisible" class is added to make
  *   the site name visually hidden, but still accessible.
  * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
  *   theme settings page. If hidden, the "element-invisible" class is added to
  *   make the site slogan visually hidden, but still accessible.
  *
  * Navigation:
  * - $main_menu (array): An array containing the Main menu links for the
  *   site, if they have been configured.
  * - $secondary_menu (array): An array containing the Secondary menu links for
  *   the site, if they have been configured.
  * - $breadcrumb: The breadcrumb trail for the current page.
  *
  * Page content (in order of occurrence in the default page.tpl.php):
  * - $title_prefix (array): An array containing additional output populated by
  *   modules, intended to be displayed in front of the main title tag that
  *   appears in the template.
  * - $title: The page title, for use in the actual HTML content.
  * - $title_suffix (array): An array containing additional output populated by
  *   modules, intended to be displayed after the main title tag that appears in
  *   the template.
  * - $messages: HTML for status and error messages. Should be displayed
  *   prominently.
  * - $tabs (array): Tabs linking to any sub-pages beneath the current page
  *   (e.g., the view and edit tabs when displaying a node).
  * - $action_links (array): Actions local to the page, such as 'Add menu' on the
  *   menu administration interface.
  * - $feed_icons: A string of all feed icons for the current page.
  * - $node: The node object, if there is an automatically-loaded node
  *   associated with the page, and the node ID is the second argument
  *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
  *   comment/reply/12345).
  *
  * Regions:
  * - regions[header] = Header
  * - regions[highlighted] = Highlighted
  * - regions[content] = Content
  * - regions[content_bottom] = Content bottom
  * - regions[footer] = Footer
  *
  * @see template_preprocess()
  * @see template_preprocess_page()
  * @see template_process()
  * @see bartik_process_page()
  * @see html.tpl.php
  */
  //echo $stand_first;
  //hide($page['content']['field_stand_first']);

  /**
  * @file
  * Returns the HTML for a single Drupal page.
  *
  * Complete documentation for this file is available online.
  * @see https://drupal.org/node/1728148
  */
  ?>

  <div id="wrapper" class="page">
    <a class="accessibility" href="#main" accesskey="s">Skip to Content</a>

    <!-- including header region into the template -->
  <?php
    print render($page['header']); 
  ?>
<!-- / header -->


<?php 
$default_image = $node->field_featured_image[LANGUAGE_NONE][0]['is_default'];
//if (!empty($node->field_featured_image)): 
if (!$default_image == 1): ?>
<section class="visual header_banner">
  <div class="img-holder">
    <div class="caption-frame">
      <div class="region region-caption-holder">
          <div class="caption-text">
            <div class="caption-text-titles">
                <div class="caption-text-title caption-text-title-1">               
                  <span>
                      <?php if ($title): ?>
                        <h1 class="title"><?php print $title; ?></h1>
                      <?php endif; ?>              
                  </span>
                </div>                    
            </div>
          </div>
      </div>
    </div>
    <div class="region region-image-holder"
      style="background-image: url('<?php print file_create_url($node->field_featured_image[LANGUAGE_NONE][0]['uri']);?>')">
    </div>
    </div>
    <?php if (!$default_image == 1): ?>
    <div class="holder">
      <span class="pic-by">  
          <?php 
            $getitemscredit = field_get_items('node', $node ,'field_photo_credit');
            $viewitemscredit = field_view_value('node', $node ,'field_photo_credit', $getitemscredit[0]); 
            if(render($viewitemscredit)){ 
            print t('© Photo by ') . render($viewitemscredit);
            }
          ?>          
      </span>
    </div>
  <?php endif; ?>
  </section>
<?php else: ?>
  <div class="top-header"></div>
<?php endif; ?>

<?php if ($page['content_top']): ?>  
  <section class="my-voice-block" id="content_top">
   <div class="holder">
    <div class="block-close"><a href="#"><span class="icon-Close"></span></a></div>
    <div class="block">
     <div class="my-voice-columns">
      <?php print render($page['content_top']); ?>
    </div>
  </div>
</div>
</section>
<?php endif; ?>
<main id="main">


  <?php if ($messages || $tabs || $action_links): ?>
  <div id="content-header">



  <?php print  $messages; ?>
  <?php print render($page['help']); ?>


  <?php if ($tabs): ?>
  <div class="tabs"><?php print render($tabs); ?></div>
<?php endif; ?>


<?php if ($action_links): ?>
  <ul class="action-links"><?php print render($action_links); ?></ul>
<?php endif; ?>

</div> <!-- /content-header -->
<?php endif; ?>


<section id="content-area">

  <?php //if (empty($node->field_featured_image)):
  if ($default_image == 1): ?>
    <h1 class="title"><?php print $title; ?></h1>
  <?php endif; ?>

  <?php print render($page['content']) ?>

 
</section> <!-- /content -->

<?php
  // Render the sidebars to see if there's anything in them.
  $sidebar_first  = render($page['sidebar_first']);
  $sidebar_second = render($page['sidebar_second']);
?>

<?php if ($page['content_bottom']): ?>
  <section id="content_bottom">
    <?php print render($page['content_bottom']); ?>
  </section> <!-- /content-bottom -->
<?php endif; ?>

</main> <!-- /main -->
<?php if ($page['action']): ?>
  <!-- action columns -->
  <section class="action-block">
    <!-- <div class="holder"> -->
    <?php print render($page['action']); ?>
    <!-- </div> -->
 </section>
 <!-- fourm block -->
<?php endif; ?>
<?php if ($page['social']): ?>
  <section id="social">
    <?php print render($page['social']); ?>
  </section> <!-- /social -->
<?php endif; ?>

<footer id="footer">
      <div class="holder">
		<div class="logo">
            <a href="<?php print $front_page; ?>"><img alt="Ambitious About Autism" src="<?php print $base_path; ?>sites/all/themes/ambitious/images/logo-footer.png"></a>
        </div>
		<div class="right-footer">
          <?php print render($page['footer_right']); ?>
        </div><!-- /footer Right --> 
        <div class="company-info">          
          <?php print render($page['footer_copyright']); ?>
          <span class="design-by">Designed by <a href="https://www.bluestatedigital.com" target="_blank">Blue State Digital</a>. Built by <a href="http://weare.thesmallaxe.com" target="_blank">The Small Axe</a>.</span>
        </div><!-- /footer copyright -->              
      </div>      
    </footer> <!-- /footer -->
    <a accesskey="t" href="#wrapper" class="accessibility">Back to top</a>
</div>
<?php print render($user_picture); ?>
<?php print render($page['bottom']); ?>
