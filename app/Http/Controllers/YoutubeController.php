<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class YoutubeController extends Controller
{
    
    public function url_get_contents($url)
    {
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
        $ret = 'No cURL data returned for $url ['. $info['http_code']. ']';
        if (curl_error($crl))
            $ret .= '<br>\n Error: '. curl_error($crl) . 'Code: ' . curl_errno($crl);
        }
        curl_close($crl);
        return json_decode($ret, TRUE);
    }

    public function generate_url($term, $maxResults) {
        $DEVELOPER_KEY = 'AIzaSyBRMUMegMNT9_mzKDezzwJNB-OORg_TVGg';
        $resp = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $term . '&maxResults=' . $maxResults . '&key=' . $DEVELOPER_KEY; 
        return $resp;
    }

    public function resultList($list) {
        $results = [];
        foreach($list['items'] as $item) {
            $id = '';
            switch ($item['id']['kind']) {
                case 'youtube#video':
                    $id = $item['id']['videoId'];
                    $url = 'https://www.youtube.com/watch?v=' . $id;
                break;
                case 'youtube#channel':
                    $id = $item['id']['channelId'];
                    $url = 'https://www.youtube.com/channel/' . $id;
                break;
                case 'youtube#playlist':
                    $id = $item['id']['playlistId'];
                    $url = 'https://www.youtube.com/playlist?list=' . $id;
                break;
            }
            $title = $item['snippet']['title'];
            $thumbnail = $item['snippet']['thumbnails']['default']['url'];
            $result = new Result([$id, $title, $url, $thumbnail]);
            $results[] = $result;
        }
        return $results;
    }
    
    public function search(Request $request) {
        $term = !empty($request->term) ? str_replace(' ', '+', $request->term) : ''; 
        $maxResults = !empty($request->maxResults) ? $request->maxResults : 5; 
        $url = $this->generate_url($term, $maxResults);
        $list = $this->url_get_contents($url);
        $results = $this->resultList($list);
        return view('results')->with('results', $results);
    } 
 
}
