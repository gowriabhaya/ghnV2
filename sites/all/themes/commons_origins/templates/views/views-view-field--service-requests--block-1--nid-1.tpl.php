<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php 
      global $user,$base_url,$theme_path;
      $uid = $user->uid;
// find out whether there is any matching available for this need nid
      $ret = ghn_need_matching($uid,$output);
      if (count($ret) > 0) {
         print '<a class="match-link" href="'.$base_url.'/match/need/'.$uid.'/'.$output.'"><img src="'.$base_url.'/'.$theme_path.'/images/checkMark.png"></a>'; 
      }
      else {
         print '<img src="'.$base_url.'/'.$theme_path.'/images/xMark.png">'; 
      }
?>
