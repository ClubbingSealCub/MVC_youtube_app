<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $ret = "No cURL data returned for $url [". $info['http_code']. "]";
        if (curl_error($crl))
            $ret .= "<br>\n Error: ". curl_error($crl) . "Code: " . curl_errno($crl);
        }
        curl_close($crl);
        return $ret;
    }

    public function generate_url($term, $maxResults) {
        $DEVELOPER_KEY = 'AIzaSyCEHlV9bz5CT1KrlIOw4bbTg_DIuit6D0c';
        return "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . $term . "&maxResults=" . $maxResults . "&key=" . $DEVELOPER_KEY;
    }

    public function search($term, $maxResults) {
        // return $this->url_get_contents($this->generate_url($term, $maxResults));
        return Redirect::route(Results($this->url_get_contents($this->generate_url($term, $maxResults))));
    } 
 
}
