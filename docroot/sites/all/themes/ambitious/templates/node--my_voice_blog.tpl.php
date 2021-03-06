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
                      <div class="blog-author">
                            <?php print render($content['field_author']) ; echo flag_create_link('bookmarks', $node->nid);?>
                           </div> 
					   <cite>
					   <?php if (!empty($first_name)): ?>
					      <span><?php print t('By') ?> <?php print $first_name; ?></span>
					    <?php endif; ?>
						  <?php /*print flag_create_link('bookmarks', $node->nid); */?> 
                           
					   </cite>
				       <div class="topic-share"><?php print $node->content['sharethis']['#value']; ?></div>
	                 </div>
	               </header>
	               <?php if (!empty($content['field_featured_image'])): ?>
	                <section class="visual">
				     <div class="img-holder">
				       <?php if($node->field_infographic_as_lightbox['und'][0]['value'] == 1){
			          print render($content['field_featured_image']); 
			        }else{ 
			          $url = image_style_url('width-684',$node->field_featured_image['und'][0]['uri']);
			          print "<img src='".$url."' />";
			        }?>
                          <?php print render($content['field_voice_image_credit']); ?> 
				     </div>
                        <?php print render($content['field_voice_image_caption']); ?> 
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
				     	<div class="topic-share"><?php print $node->content['sharethis']['#value']; ?></div>
				       <div class="article-updated">

					     <strong><?php print t('Last updated:') ?> <time pubdate="pubdate"><?php print date('j F Y', $node->changed);?></time></strong>
					     <div class="article-tags">
						 	<span>Related topics: </span>
							<?php print render($content['field_related_topic']); ?>
						 </div>
					  	 <div class="article-tags">
							   <span>Tags: </span>
								<?php print render($content['field_tags']); ?>
						 </div class="article-tags" >
	                   
	                 </div>
	              </footer>
	              <!-- comment columns -->		
	              <?php  print render($content['comments']); ?>
	          </article>	              
			</section>		      

			</div>
			<div class="article-right">
				<?php print render($region['sidebar_second']); ?>
			</div>
						
		</section>
