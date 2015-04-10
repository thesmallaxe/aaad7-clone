<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row):?>
<?php
   $styleclass = '';
   /*if($id < 3 && $view->query->pager->current_page === 0){
        $styleclass = 'lessthen3';
   } */
   
?> 
<?php /* if($id == 3 && $view->query->pager->current_page === 0){
       $block = module_invoke('block', 'block_view', '96');
	  print render($block['content']);
     }*/ ?> 
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] . $styleclass . '"';  } ?>>
     <?php print $row;?>   
  </div>
<?php endforeach; ?>
