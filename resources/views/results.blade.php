<!doctype html>
<html>
  <head>
  </head>
    <body>
        <ul style="list-style-type:none;">
            <?php
            foreach($results as $result) {
                print_r($result->generateHTML());
            }
            ?>
        </ul>
    </body>
</html>


