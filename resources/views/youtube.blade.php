<?php
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
  echo $ret;
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
    <script>
      function showResults(str) {
        if {
          str.length == 0 document.getElementById("target").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("target").innerHTML = this.responseText;
            }
          };
        }
      };
    </script>
    <title>YouTube Search</title>
  </head>
  <body>
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
  </body>
</html>