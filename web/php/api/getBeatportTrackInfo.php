<?php

// This class parse a https://pro.beatport.com/track/* link.
// and returns informations about the track.

require(dirname(__FILE__).'/../lib//simple_html_dom.php');


ini_set('max_execution_time', 300);

$base_url = 'https://pro.beatport.com/track/neptune-original-mix/7584051';
if(strpos($base_url, '//pro.beatport.com/track/') > 0){
  $extra_fetch_url = '?_pjax=%23pjax-inner-wrapper';
  $html = file_get_html($base_url.$extra_fetch_url);
  try {
      $staring = strpos($html, 'window.Playables = ')+19;
      $ending = (strpos($html, 'window.Sliders'));
      if($staring == 19 || $ending == 0){
        throw new Exception('Wrong Url');
      }
      $trackJSON = substr($html,$staring, $ending-$staring);  // returns "abcde"
      echo $trackJSON; 
  } catch (Exception $e) {
      echo "{error: 'Error with the link, contact support.'}";
  }
} else {
  echo "{error: 'URL not valid.'}";
}
?>