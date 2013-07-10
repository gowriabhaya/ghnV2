<?php
/**
 * @file
 * Adaptivetheme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Adaptivetheme Variables:
 * - $html_attributes: structure attributes, includes the lang and dir attributes
 *   by default, use $vars['html_attributes_array'] to add attributes in preprcess
 * - $polyfills: prints IE conditional polyfill scripts enabled via theme
 *   settings.
 * - $skip_link_target: prints an ID for the skip navigation target, set in
 *   theme settings.
 * - $is_mobile: Bool, requires the Browscap module to return TRUE for mobile
 *   devices. Use to test for a mobile context.
 *
 * Available Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 * @see adaptivetheme_preprocess_html()
 * @see adaptivetheme_process_html()
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"<?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"<?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"<?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9"<?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html<?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head>
<?php print $head; ?>
<title><?php print $head_title; ?></title>
<?php print $styles; ?>
<?php print $scripts; ?>
<?php print $polyfills; ?>
<!--
    <link href="https:/developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVmGX8dbdk14RLAjqvuN2KbS3F0mQ3wKI&sensor=false"></script>
-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-8hpce2_DgNeK4GJpEBn11ee6n1mhwv0&sensor=false"></script>
    <script>
var berlin = new google.maps.LatLng(52.520816, 13.410186);
var coords = [];
var info = [];
/*
var coords = [
  new google.maps.LatLng(30.0444196, 31.2357116),
  new google.maps.LatLng(51.5112139, -0.1198244),
  new google.maps.LatLng(32.7801399, -96.8004511),
];
var info = [
  'GHN',
  'GHN',
  'GHN',
];
*/
var markers = [ ];
var map;
var iterator = 0;
function initialize() {
  var pointers;
  var point = [];
  var mapOptions = {
    zoom: 2,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: berlin
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);
  var xmlhttp;
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  strURL = window.location.pathname;
  comp = strURL.split('/');
  switch (comp[1]) {
     case 'conference-list':
          pageType = "conference_announcement";
          break;
     case 'cvd-registry':
          pageType = "hospital";
          break;
     case 'medical-missions':
          pageType = "medical_mission";
          break;
     case 'ghn-posts':
          if (comp[2] == 'needs')
             pageType = "need_post";
          else if (comp[2] == "resources")
             pageType = "resource_post";
          break;
     default:
          pageType = comp[1];
          break;
  }
  //strURL = "http://dev.ghn.org/map-array/medical_mission";
  strURL = "/map-array/"+pageType;
  xmlhttp.open('POST', strURL, true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send();
  xmlhttp.onreadystatechange=function() {
     if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        resp = xmlhttp.responseText;
        //document.getElementById("map-coords").innerHTML = resp;
        pointers = resp.split(';');
        for (i=0; i < pointers.length; i++) {
           point = pointers[i].split('|');   
           coords[i] = new google.maps.LatLng(point[3],point[2]);
           info[i] = point[0]+'('+point[1]+')';
         }
         //window.setTimeout(drop(coords,info),5000);
         drop(coords,info);
      }
  }
}
google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div id="skip-link">
    <a href="<?php print $skip_link_target; ?>" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
