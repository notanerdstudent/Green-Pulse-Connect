<?php

use App\Models\Setting;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Carbon\Carbon;

if (!function_exists('blogInfo')) {
    function blogInfo()
    {
        return Setting::find(1);
    }
}

// Date Format
if (!function_exists('data_formatter')) {
    function data_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }
}

// Strip Words
if (!function_exists('words')) {
    function words($string, $words = 20, $end = '...')
    {
        return Str::words(strip_tags($string), $words, $end);
    }
}

// Check if user's online
if (!function_exists('isOnline')) {
    function isOnline($site = "https://google.com")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}

// Article Read Duration
if (!function_exists('readDuration')) {
    function readDuration(...$text)
    {
        Str::macro('timeCounter', function ($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);
            return (int)max(1, $minutesToRead);
        });

        return Str::timeCounter($text);
    }
}

// Display Latest Post
if (!function_exists('single_latest_post')) {
    function single_latest_post()
    {
        return Post::with('author')->with('subcategory')->limit(1)->orderBy('created_at', 'desc')->first();
    }
}

// 6 Posts Grid
if (!function_exists('latest_6posts')) {
    function latest_6posts()
    {
        return Post::with('author')->with('subcategory')->skip(1)->limit(6)->orderBy('created_at', 'desc')->get();
    }
}

// Random Posts
if (!function_exists('recommended_posts')) {
    function recommended_posts()
    {
        return Post::with('author')->with('subcategory')->limit(4)->inRandomOrder()->get();
    }
}

// Categories List
if (!function_exists('categories')) {
    function categories()
    {
        return Subcategory::whereHas('posts')->with("posts")
            ->orderBy('ordering', 'asc')
            ->get();
    }
}


// Oldest Post
if (!function_exists('oldest_post')) {
    function oldest_post()
    {
        return Post::with('author')->with('subcategory')->limit(1)->orderBy('created_at', 'asc')->first();
    }
}

// Sidebar Posts
if (!function_exists('latest_sidebar_posts')) {
    function latest_sidebar_posts($except = null, $limit = 3)
    {
        return Post::where('id', '!=', $except)->limit($limit)->with('author')->with('subcategory')->orderBy('created_at', 'desc')->get();
    }
}


// Tags
if (!function_exists('tags')) {
    function tags()
    {
        return Post::where('post_tags', '!=', null)->distinct()->pluck('post_tags')->join(',');
    }
}
