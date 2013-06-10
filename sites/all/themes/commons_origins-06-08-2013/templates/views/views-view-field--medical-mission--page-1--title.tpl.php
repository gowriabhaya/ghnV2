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
      $fields = explode('/',$output);
      $nid = $fields[0];
      $title = $fields[1];
// find out whether there is any matching available for this need nid
      $iso2 = _ghn_node_iso2($nid);
      $flag = _ghn_country_flag($iso2);
      $output = '<a href="'.$base_url.'/node/'.$nid.'">'.$flag.' '.$title.'</a>';
      print $output;
?>
