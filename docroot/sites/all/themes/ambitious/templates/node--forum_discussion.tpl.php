<?php
	/**
	 * @file
	 * Returns the HTML for a node.
	 *
	 * Complete documentation for this file is available online.
	 * @see https://drupal.org/node/1728164
	 */

	/* variables */ 
	$themeurl =  base_path().drupal_get_path('theme', 'ambitious');
	$name = strip_tags($name); 
	$not_flag_comment = ambitious_get_node_comments_count($node->nid);
	drupal_add_library('waypoints', 'waypoints');
	hide($content['comments']['comments']);
	$weeks = variable_get('autism_custom_past_week', 0);
	$comment = ambitious_get_node_comments_count($node->nid);
	$flaged_comments_count = ambitious_get_node_flaged_comments_count($node->nid);
	$comment_count =  abs($comment - $flaged_comments_count);
	$uid = $node->uid;
	$userinfo = user_load($uid);
	

   	$last_reply = ambitious_get_last_reply($node->nid);
  
  	if ($last_reply){
	    $last_reply_user = user_load($last_reply->uid);
	    $last_reply_username = theme('username', array('account' => $last_reply_user));
	    $last_reply_time = format_date($last_reply->changed);
  	} 

	// author signature to be added to the discussion threads.
	if(isset($userinfo->field_signature['und']['0']['safe_value'])){
		$user_signature = $userinfo->field_signature['und']['0']['safe_value'];
	}
	if(isset($userinfo->field_location_reference['und']['0']['tid'])){
		$location = $userinfo->field_location_reference['und']['0']['tid'];
		$location = taxonomy_term_load($location);
		$location = $location->name;
	}

	$user_date = format_date($userinfo->created, 'custom', t('d F Y', array(), array('context' => 'php date format')));
	$user_count = ambitious_get_user_post_count($uid);
	// if(isset(taxonomy_term_load($location))){
	// 	$location = taxonomy_term_load($location);
	// }
	// if(isset($location->name)){
	// 	$location = $location->name;
	// }
    // we use custom_comment_count value form user settings form if the value is empty default value 5
	$popular_thread_comment_threshold = variable_get('autism_custom_comment_count', 5);
?>   
<div class="posts-columns columns-full">
<div class="row">
<section style="width:100%;" class="post">
   	<?php if($pastcomments >= $popular_thread_comment_threshold): ?>
    	<em class="icon-Hottopic forum-icon" title="Popular Discussion" alt="Popular Discussion"></em>	
   	<?php endif; ?>  
    <div class="forum-text">						
		<div class="forum-left"> 
			<div class="image-holder">
				<?php if(!empty($user_picture)):?>
				    <?php print render($user_picture); ?>
				<?php else: ?>
					<img src="<?php print $themeurl;?>/images/profile-picture-1.jpg" alt="image description" />
				<?php endif; ?>						      
			</div>
			<cite>by </br><strong title="<?php print $name; ?>"> 
			<?php if($logged_in):?><a href="<?php print url('user/'.$uid); ?>"><?php print $name;?></a><?php else:?><?php print $name;?><?php endif; ?></strong></cite>                <time pubdate>Joined: <?php print $user_date; ?></time></br>
				<time pubdate>Posts: <?php print $user_count; ?></time></br>
			<?php if(!empty($location)){ ?>
				<time>Location: <?php print $location; ?></time>
			<?php } ?>                                             
		</div>
		  <div class="info add forum-right">
		    <?php if(isset($title)): ?>						     
		    	<h3><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
		    <?php else :?>						    
				<h3>Discussion</h3>
			<?php endif;?> 
			<div class="meta">
		        <div class="created">
		           <?php print format_date($node->created, 'custom', 'D j M Y g:ia');?>
		        </div>
		        <?php if(isset($content['field_topic'])):?>	
		        <div class="topic_section">
		            <?php print render($content['field_topic']);?>
		        </div>
		        <?php endif; ?>
		        <div class="clear"></div>
		    </div>
		    
		      
			<?php print render($content['body']);?>		
			
			<?php if(!empty($user_signature)): ?>
				<div class="signature-dashes">--</div>
				<div class="user_signature signature-bold-text">	
					<?php print $user_signature; ?>
				</div>
			<?php endif;?>
			
		  </div>						  
	</div> 
						<div class="footer">
						<div class="flag_node">							  
							  <?php print flag_create_link('bookmarks', $node->nid); ?>
							  </br>
							  <?php print flag_create_link('flags', $node->nid); ?>
							</div>
                          <div class="num-holder">
							<a href="<?php print $node_url ?>#comments" title="replies" class="open">
							  <span class="num"><?php print $comment_count; ?></span>
							  <span class="text" style="display:inherit;">replies</span>
							</a>
						  </div> 
						  <div class="times" <?php if($comment_count == 0){ ?> style="display:none;" <?php }; ?>>
						    <em class="icon-Time"></em> 
							Last reply by <cite><?php print $last_reply_username;  ?></cite>, <time pubdate="pubdate"> <?php print $last_reply_time;  ?></time> 
					     </div>  
						 <div class="forum_replay">
						  <?php if($user->uid):?>
						   <a href="<?php print $node_url ?>#comment-form" class="btn btn-right" title="Reply">Reply</a>
						   <?php else:?>
						   <a href="/user/login?destination=node/<?php print $node->nid ; ?>#comment-form" class="btn btn-right" title="Reply">Reply</a>
						   <?php endif; ?>
						 </div>
					  </div>  
					</section>
<?php if ($page): ?>		
<h4 class="forumpage_title">
     <a href="/talk-to-others" title="Back to discussions">Back to discussions</a></br><a href="#" title="Read our guidelines">Read our guidelines</a></br><?php print $comment_count; ?>
    <?php if($comment_count > 1){
      print t('Comments');
      }else{
        print t('Comment');
      }
    ?></h4>
<?php endif; ?>
  
 </div>
  </div>
<?php if ($page): ?>
  <?php print views_embed_view('comments','comments', $node->nid); ?>
  <h4 class="forumpage_title"><a href="/talk-to-others" title="Back to discussions">Back to discussions</a></h4>
 			<?php if($content['comments']['comment_form']):?>   
		
 <?php print render($content['comments']);   ?>
 
<?php endif; ?>
<?php endif; ?>
