<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */

/* variables */ 
  
  $node = node_load(arg(1)); 
  $links = sharethis_node_view($node, 'full', 'en');
  $base_path = '/';

  global $user;
  $user_fields = user_load($user->uid);
  $first_name = field_get_items('user', user_load($node->uid), 'field_first_name');
  
?> 
		<!-- contain main informative part of the site -->
		<section class="article node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
			<div class="article-left">
	           <section class="article-left-holder">
			   <!-- article -->
	             <article>
	               <header>
	                 <h1><?php print $title; ?></h1>
					<?php if (!empty($content['field_standfirst'])) : ?> 
	                 	<h2 class="subheading"><?php print $content['field_standfirst']['#items'][0]['value']; ?></h2>
	                <?php endif; ?> 
	                 <div class="article-info">
					   <cite>
					   <?php if (!empty($first_name)): ?>
					      <span><?php print t('By') ?> <?php print $first_name; ?></span>
					    <?php endif; ?>
					      <a href="<?php print $base_path.'user/'.$uid; ?>" class="first">@<?php print $node->name; ?></a>
						  <a href="<?php print url('messages/new/'. $node->uid, array ('query' => drupal_get_destination())); ?>" title="email the author">email the author</a>
					   </cite>
				       <div class="topic-share"><?php print $node->content['sharethis']['#value']; ?></div>
	                 </div>
	               </header>
	               <?php if (!empty($content['field_featured_image'])): ?>
	                <section class="visual">
				     <div class="img-holder">
				       <?php print render($content['field_featured_image']); ?>
				       <a href="#" class="btn-gray-perv" title="Leftarrow"><span class="icon-Leftarrow"></span></a>
				       <a href="#" class="btn-gray-next" title="Rightarrow"><span class="icon-Rightarrow"></span></a>
				     </div>
				     <div class="holder">
				     	<?php if (!empty($content['field_image_caption'])): ?>
				       		<span class="pic-caption"><?php print $content['field_image_caption']['#items'][0]['value']; ?></span>
				       <?php endif; ?>
				       <?php if (!empty($content['field_image_credit'])): ?>
				       	<span class="pic-by"><?php print t('&copy; Photo by');?> <a href="#" title=""><?php print $content['field_image_credit']['#items'][0]['value']; ?></a>.</span>
				       <?php endif; ?>
				     </div> 
				  </section>
				<?php endif; ?>
				  <?php print render($content['body']); ?>
	               <footer>
				     <div class="article-info">
				       <div class="article-updated">

					     <strong><?php print t('Last updated:') ?> <time pubdate="pubdate"><?php print date('j F Y', $node->changed);?></time></strong>

					  	<?php if (!empty($content['field_tags'])): ?>   
							 <div class="article-tags">
							   <span>Tags: </span>
								<?php print render($content['field_tags']); ?>
							 </div>
						<?php endif; ?>
					   </div>
	                   <div class="topic-share"><?php print $node->content['sharethis']['#value']; ?></div>
	                 </div>
	              </footer>
	          </article>
	          <?php if($region['sidebar_second']): ?>
      			<div class="article-right">
        			<?php print render($region['sidebar_second']); ?>
      			</div>
  				<?php endif; ?>
		      <!-- comment columns -->
			<?php  print render($content['comments']); ?>

			</div>
						
		</section>
