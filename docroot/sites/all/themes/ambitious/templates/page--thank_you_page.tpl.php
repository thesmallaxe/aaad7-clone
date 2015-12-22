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
  <?php 
    $transid = $_GET['id'];
    $transactiontotal = intval(lists_session("total"));
    $sku = lists_session("sku");
    $name = lists_session("name");
    $price = intval(lists_session("price"));
    $quantity = intval(lists_session("quantity"));

    //adding them to the datalayer

    if(!is_null($sku)){
      datalayer_add(array(
      'event' => 'Donation',
      'transactionId' => $transid,
      'transactionTotal' => $transactiontotal, 
      'transactionProducts' => [array(
        'sku' => $sku,
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity,
        )]
      ));
    }
    //closing the session values
    stripe_custom_unset_session();
  ?>
  // <script>
  // dataLayer = [{
  //   'transactionId' : '<?php echo $transid;?>',
  //   'transactionTotal' : '<?php echo $transactiontotal; ?>',
  //   'transactionProducts' : [{
  //     'sku' : '<?php echo $sku; ?>',
  //     'name' : '<?php echo $name; ?>',
  //     'price' : '<?php echo $price; ?>',
  //     'quantity' : '<?php echo $quantity; ?>'
  //   }]
  // }];
  // </script>

  <div id="wrapper" class="page" <?php if($backgroundimage): ?>
           style="background-image: url('/<?php print variable_get('file_public_path', conf_path().'/files').'/'; print($backgroundimage['#item']['filename']); ?>')"
        <?php endif; ?>>
        >
    <a class="accessibility" href="#main" accesskey="s">Skip to Content</a>

    <!-- including header region into the template -->
  <?php
    print render($page['header']); 
  ?>
<!-- / header -->

 <?php if ($page['image_holder']): ?>
<section class="header_banner banner-nav">
    <div class="header_image">
      <?php if ($page['image_holder']): ?>
        <?php print render($page['image_holder']); ?>
      <?php endif; ?>
  </section>
<?php endif; ?>

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


  <?php if ($title|| $messages || $tabs || $action_links): ?>
  <div id="content-header">

    <?php if ($title): ?>
    <h1 class="title"><?php print $title; ?></h1>
  <?php endif; ?>


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
<?php if($_GET['result'] == 'error'): ?>
  <div class="field-name-body">
  <h4>
    <div class="error">
      <?php echo 'We are unable to process your request at this time.';?>
    </div>
    <div>
      <?php echo 'Please double check your details and try again. Alternatively, please dial 020 8815 5433 to process your donation over the telephone or email <a href="mailto:fundraising@ambitiousaboutautism.org.uk" target="_top">fundraising@ambitiousaboutautism.org.uk</a>.'; ?>
    </div>
    </h4>
  </div>
<?php elseif($_GET['result'] == 'card-declined'): ?>
  <div class="field-name-body">
  <h4>
    <div class="error">
      <?php echo 'Your card is declined.';?>
    </div>
    <div>
      <?php echo 'Please double check your details and try again. Alternatively, please dial 020 8815 5433 to process your donation over the telephone or email <a href="mailto:fundraising@ambitiousaboutautism.org.uk" target="_top">fundraising@ambitiousaboutautism.org.uk</a>.'; ?>
    </div>
    </h4>
  </div>
<?php else :?>
  <section id="content-area">
  <?php print render($page['content']) ?>

  <div class="sharethis-buttons">
      <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $_SERVER['SERVER_NAME']; ?>/donations/donation-page" 
      onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="csuttons" data-type="facebook" ><img src="/sites/all/themes/ambitious/images/share_button/fb.png" alt=""></a>
      <a href="#" class="csbuttons" data-type="twitter" data-txt="I have just contributed to a worthy cause. Help support Ambitious About Autism." ><img src="/sites/all/themes/ambitious/images/share_button/tw.png" alt=""></a>
      <!-- <a href="#" class="csbuttons" data-type="google" data-lang="fr"><img src="/sites/all/themes/ambitious/images/share_button/gp.png" alt=""></a> -->

<!--   <div class="fb-share-button" 
      data-href="https://www.ambitiousaboutautism.org.uk/donations/donation-page" 
      data-layout="button_count"> -->
  </div>
    </p>
  </div>
  </section>
<?php endif ; ?>

<!-- <section id="content-area">
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
