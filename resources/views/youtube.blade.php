<?php
?>

<!doctype html>
<html>
  <head>
    <script>
      function search() {//(term, maxResults) {
        var term = document.getElementById("term").value;
        var maxResults = document.getElementById("maxResults").value;
        if (term.length == 0) {
           document.getElementById("searchResult").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("searchResult").innerHTML = this.responseText;
            }
          };
          var attributes = "&term=" + term + "$maxResults=" + maxResults;
          xmlhttp.open("GET", "search?" + attributes, true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send();
        }
      };
    </script>
    <title>YouTube Search</title>
  </head>
  <body>
    <form method="GET">
      <div>
        Search Term: <input type="search" id="term" name="term" placeholder="Enter Search Term">
      </div>
      <div>
        Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
      </div>
      <input type="submit" onclick="search()" value="Search">
      </form>
    <div id="searchResult"></div>
  </body>
</html>