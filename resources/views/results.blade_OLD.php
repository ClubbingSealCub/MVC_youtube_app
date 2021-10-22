<!doctype html>
<html>
  <head>
  </head>
    <body>
        <ul style="list-style-type:none;">
            <?php
            // print_r($list);
            foreach($list['items'] as $item) {
                // echo('<li>');
                // print_r($item['snippet']['title']);
                // echo('</li>');
                $id = '';
                switch ($item['id']['kind']) {
                    case 'youtube#video':
                        $id = $item['id']['videoId'];
                        $link = 'https://www.youtube.com/watch?v=' . $id;
                    break;
                    case 'youtube#channel':
                        $id = $item['id']['channelId'];
                        $link = 'https://www.youtube.com/channel/' . $id;
                    break;
                    case 'youtube#playlist':
                        $id = $item['id']['playlistId'];
                        $link = 'https://www.youtube.com/playlist?list=' . $id;
                    break;
                }
                $title = $item['snippet']['title'];
                $thumbURL = $item['snippet']['thumbnails']['default']['url'];
                // $thumbURL = "https://img.youtube.com/vi/" . $id . "/mqdefault.jpg";
                printf('<li><img src="%s" width="120" height="90"> <a href="%s">%s</a> (ID: %s) </li>', $thumbURL, $link, $title, $id);
            }
            ?>
        </ul>
    </body>
</html>


