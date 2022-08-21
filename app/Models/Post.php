<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    //3 ways to do migration
    protected $guarded = [];

    //protected $guarded = ['id'];

    // protected $fillable = ['title', 'excerpt', 'body'];

    /* This returns the key/attribute that we want to find post according to it.
     * If we have many routes we can use this.
    public function getRouteKeyName()
    {
        return 'slug';
    }*/


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
