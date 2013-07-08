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
// get all the affiliations of this user
     $results = db_query("SELECT pid FROM {profile} p WHERE p.uid = :uid AND p.type = :type LIMIT 1",array(':uid'=>$output,':type'=>'affiliations'));
     $pid = 0;
     $ret = '';
     foreach ($results AS $result) {
        if ($result->pid) $pid = $result->pid;
     } 
     if ($pid != 0) {
        $results = db_query("SELECT f.field_affiliations_value AS affiliation FROM  {field_data_field_affiliations} f WHERE f.entity_id = :pid AND f.bundle = :bundle AND f.entity_type = :type",array(':pid'=>$pid,':bundle'=>'affiliations',':type'=>'profile2'));
        foreach ($results AS $result) {
           $ret .= '<li>'.$result->affiliation.'</li>';
        }
     }
     if ($ret != '') $output = '<ul>'.$ret.'</ul>';
     else $output = 'No affiliation';
     print $output; 
?>

