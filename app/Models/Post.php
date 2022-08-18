<?php


namespace App\Models;

class Post{

    public static function find($slug){
        if(! file_exists($path = __dir__ . "/../resources/posts/{$slug}.html")){
            return redirect('/');
        }
        
        return cache()->remember("post.{$slug}", 1200, fn()  => file_get_contents($path));
        
    }
}