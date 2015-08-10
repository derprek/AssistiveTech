<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [

    	'title',
    	'body',
    	'published_at',
    	'user_id'
    ];

    public function scopePublished($query)
    {
    	$query->where('published_at', '<=', Carbon::now());

    }

      public function scopeUnPublished($query)
    {
    	$query->where('published_at', '>', Carbon::now());

    }

    	// set name attributute eg setaddressattribute
    public function setPublishedAtAttribute($date)
    {
    	$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function user()
    {
        return $this->belongsTo('App\User'); // form relation

    }
}
