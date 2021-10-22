<?php

namespace App\Models;

class Result
{
    protected $id = '';
    protected $title = '';
    protected $url = '';
    protected $thumbnail = '';

    public function __construct(array $attributes = array()) {
        $this->id = $attributes[0];
        $this->title = $attributes[1];
        $this->url = $attributes[2];
        $this->thumbnail = $attributes[3];
    }

    public function generateHTML()
    {
        return '<li><img src="'. $this->thumbnail . '" width="120" height="90"> <a href="' . $this->url . '">' . $this->title . '</a> (ID: '. $this->id . ') </li>';
    }
}

