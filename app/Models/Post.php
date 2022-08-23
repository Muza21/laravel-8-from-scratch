<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    //3 ways to do migration
    protected $guarded = [];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $fillters) // Post::newQuery()->filter()
    {
        $query->when($fillters['search'] ?? false, fn ($query, $search) =>
        $query
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%'));

        $query->when(
            $fillters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );
    }

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

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
