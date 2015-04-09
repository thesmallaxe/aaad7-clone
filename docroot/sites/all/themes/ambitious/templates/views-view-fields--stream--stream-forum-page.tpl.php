<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php
  $class = '';  
    $node_comment = ambitious_get_node_comments_count($fields['nid']->raw) ;
  $node_flag_comment = ambitious_get_node_flaged_comments_count($fields['nid']->raw) ; 
  $real_comment_count = abs($node_flag_comment - $node_comment) ;
  
  $commentcout = ambitious_get_node_comments_count($fields['nid']->raw);
      if($commentcout > 3){
        $class = 'commentcoutmore3';
      }
      if (module_exists('autism_custom')) {
        $hot_comment = getcommentcount_past2week($fields['nid']->raw);
        if ($hot_comment > 5) {
          $class .= ' show_hot';
        }
      }
      ?> 
     
 <div class="<?php print $class;  ?>"  data-commentcount="<?php print $real_comment_count; ?>" >
<?php foreach ($fields as $id => $field): ?> 
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>
  
  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    
      <?php print $field->content; ?>
  
  <?php print $field->wrapper_suffix; ?> 
  
<?php endforeach; ?>
  </div> 
