<?php

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
  */
// if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
//   throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
// }

// require_once __DIR__ . '/vendor/autoload.php';



$htmlBody = <<<END
<form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search">
</form>
<div id="target"></div>
END;

function url_get_contents($url){
  $crl = curl_init();
  $timeout = 10;
  curl_setopt_array($crl, array(
      CURLOPT_URL => $url,
      CURLOPT_ENCODING => 'UTF-8',
      CURLOPT_RETURNTRANSFER => '1',
      CURLOPT_FOLLOWLOCATION => '1',
      CURLOPT_CONNECTTIMEOUT => $timeout)
  );
  $ret = curl_exec($crl);
  $info = curl_getinfo($crl);

if ($ret === false || $info['http_code'] != 200) {
  $ret = "No cURL data returned for $url [". $info['http_code']. "]";
  if (curl_error($crl))
    $ret .= "<br>\n Error: ". curl_error($crl) . "Code: " . curl_errno($crl);
}
  curl_close($crl);
  return $ret;
}

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if (isset($_GET['q']) && isset($_GET['maxResults'])) {
  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google API Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyCEHlV9bz5CT1KrlIOw4bbTg_DIuit6D0c';
  $term = $_GET['q'];
  $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . $term . "&key=" . $DEVELOPER_KEY; 
  $searchResponse = url_get_contents($url);

}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
  </head>
  <body>
    <?=$htmlBody?>
  </body>
</html>