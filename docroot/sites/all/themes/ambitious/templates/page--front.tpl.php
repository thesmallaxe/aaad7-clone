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
<?php print $messages; ?> 
<!-- Adding alerts -->
<?php if ($page['image_holder']): ?>
  <?php print render($page['image_holder']); ?>
  <!-- /image holder -->
<?php endif; ?>
  <section class="visual header_banner">
    <div class="img-holder <?php print (isset($node->field_hero_video['und'][0]['video_id']))? 'with-video':'' ?>">
      <div class="caption-frame">
        <div class="region region-caption-holder">
          <?php if($captionone || $captiontwo ): ?>
            <div class="caption-text">
              <div class="caption-text-titles">
              <?php if($captionone): ?>
                <?php $captionone_render = trim(render($captionone)); ?>
                <?php if(!empty($captionone_render)): ?>
                  <div class="caption-text-title caption-text-title-1">               
                    <h1><?php print $captionone_render; ?></h1>           
                  </div>
                <?php endif; ?>
              <?php endif; ?>

              <?php if($captiontwo): ?>
                <?php $captiontwo_render = render($captiontwo); ?>
                <?php if(!empty($captiontwo_render)): ?>              
                  <div class="caption-text-title caption-text-title-2">
                    <h1><?php print $captiontwo_render; ?>   </h1>             
                  </div>
                <?php endif; ?>        
              <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <?php if($image): ?>
       <!--  <div class="home region region-image-holder" style="background-image: url('/<?php //print variable_get('file_public_path', conf_path() . '/files') . '/'; print($image['#item']['filename']); ?>')"> -->

          <div class="home region region-image-holder" style="background-image: url('<?php print file_create_url($image['#item']['uri']); ?>')">


          <div class="cta-holder">
            <?php print render($page['caption_holder']); ?>
          </div>
        </div> 
      <?php endif; ?>
      <?php if(isset($node->field_hero_video['und'][0]['video_id'])): ?>
      	<div class="u-video__wrapper">
  	      <iframe class="u-video" id="youtubeVid" src="https://www.youtube.com/embed/<?php print $node->field_hero_video['und'][0]['video_id']  ?>?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;playlist=<?php print $node->field_hero_video['und'][0]['video_id']  ?>&amp;loop=1" frameborder="0" allow="encrypted-media" allowfullscreen></iframe> 
      	</div>
      <?php endif; ?>
    </div>
    <?php if($credit && !isset($node->field_hero_video['und'][0]['video_id']) ): ?>
      <?php $credit_render = render($credit); ?>
      <?php if(!empty($credit_render)): ?>
        <div class="holder">
          <span class="pic-by">          
              <?php print t('© Photo by ') . render($credit_render); ?>          
          </span>
        </div>
      <?php endif; ?>
    <?php endif; ?>         
  </section>

  <?php //if ($page['header_form']): ?>    <!-- slider block -->
   <!--  <section class=" slider-block">
      <div class="holder">
      <div class="block-close"><a href="#"><span class="icon-Close"></span></a></div>      
      <?php  //print render($page['header_form']); ?>       
      </div>
    </section> -->
  <?php //endif; ?>
  <?php if ($page['navigation']): ?>
    <section id="navigation">
      <?php print render($page['navigation']); ?>
    </section> <!-- /navigation -->
  <?php endif; ?>

  <?php if ($page['highlighted']): ?>
    <section id="highlighted">
      <?php print render($page['highlighted']); ?>

      <?php if ($breadcrumb): ?>
        <h1 class="breadcrumb"><?php print $breadcrumb; ?></h1>
      <?php endif; ?>

    </section> <!-- /highlighted -->
  <?php endif; ?>



  <main id="main">
  <?php print render($page['content']['metatags']); ?>
  
  <?php if ($title || $messages || $tabs || $action_links): ?>
    <div id="content-header">

      <?php if ($title): ?>
        <h1 class="title"><?php print $title; ?></h1>
      <?php endif; ?>


      <?php if ($tabs): ?>
        <div class="tabs"><?php print render($tabs); ?></div>
      <?php endif; ?>


      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      
    </div> <!-- /content-header -->
    <?php endif; ?>

  <?php if ($page['content_top']): ?>
    <section id="content_top">
      <?php print render($page['content_top']); ?>
    </section> <!-- /content-top -->
  <?php endif; ?>   


  <?php if ($page['content_bottom']): ?>
    <section id="content_bottom">
      <?php print render($page['content_bottom']); ?>
    </section> <!-- /content-bottom -->
  <?php endif; ?>

  </main> <!-- /main -->
    
    <!-- action columns -->
    <section class="action-block">
      <!-- Render the action block region. -->
      <?php print render($page['action']); ?>
    </section>
    
    <section class="articles-block" >
      <div class="holder">
        <h2>We are Ambitious about Autism</h2>
        <div class="articles-columns" >
          <?php print render($page['services']); ?>
          <!--column one -->

        </div>
      </div>    
  </section><!-- /services -->
<section class="action-block-bottom" >
<?php print views_embed_view('block_stream', 'block_stream_homepage_bottom');  ?>
</section><!-- /services -->

  <section class="social-block">
    <div class="holder">
      <h1>Stay ambitious</h1>
      <div class="block">
        <div class="social-columns" >
          <?php print render($page['social']); ?>
           
              <?php
              //Watch us youtube block
              $block = module_invoke('block', 'block_view', '61');
              print render($block['content']);
              ?>

          <!-- social column mid -->
          <div class="col block-twitter">
            <h6>Latest from Twitter</h6>
            <div class="twitter">
              <a class="twitter-timeline" href="https://twitter.com/AmbitiousAutism" data-widget-id="557083103072489472" width="300" height="500">Tweets by @AmbitiousAutism</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
          </div>
          <!-- social column right -->
          <div class="col block-facebook">
            <h6>Find us on Facebook</h6>
              <div id="desktopFB" class="facebook">
                  <div id="fb-like-box" class="fb-like-box" data-href="https://www.facebook.com/ambitiousaboutautism" data-width="300" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"></div>
              </div>
              <div id="ipadFB" class="facebook">
                <div id="fb-like-box" class="fb-like-box" data-href="https://www.facebook.com/ambitiousaboutautism" data-width="200" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"></div>
              </div>
          </div>
        </div>
      </div>
    </div>
      <div class="bg-stretch home-bg-stretch">
      </div>
    </section>

  <footer id="footer">
      <div class="holder">
		<div class="logo">
<a href="<?php print $front_page; ?>"><img alt="Ambitious About Autism" src="<?php print base_path().drupal_get_path('theme', 'ambitious') ?>/images/logo-footer.png"></a>        </div>
		<div class="right-footer">
          <?php print render($page['footer_right']); ?>
        </div><!-- /footer Right --> 
        <div class="company-info">          
          <?php print render($page['footer_copyright']); ?>
          <span class="design-by">Designed by <a href="https://www.bluestatedigital.com" target="_blank">Blue State Digital</a>. Built by <a href="http://weare.thesmallaxe.com" target="_blank">The Small Axe</a>.</span>     </div><!-- /footer copyright -->
        </div><!-- /footer copyright -->              
      </div>      
    </footer> <!-- /footer -->
    <a accesskey="t" href="#wrapper" class="accessibility">Back to top</a>  
</div>
<?php print render($user_picture); ?>
<?php print render($page['bottom']); ?>