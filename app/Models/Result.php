<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'kind',
        'channelId',
        'channelTitle',
        'publishedAt',
        'title',
        'description',
        'thumbnailS',
        'thumbnailM',
        'thumbnailL',
    ];

    public function getThumbnail()
    {
         return 'https://img.youtube.com/vi/' . $this . '/default.jpg';
}

}
