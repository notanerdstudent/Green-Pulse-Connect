<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function categoryPosts(Request $request, $slug)
    {
        if (!$slug) {
            abort(404);
        } else {
            $subcategory = Subcategory::where('slug', $slug)->first();
            if (!$subcategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subcategory->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

                $data = [
                    'pageTitle' => 'Category - ' . $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts,
                ];
                return view('frontend.pages.category_posts', $data);
            }
        }
    }

    public function searchBlog(Request $request)
    {
        $query = $request->query('query');
        if ($query && strlen('query') >= 2) {
            $searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();
            $posts->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('post_title', 'LIKE', "%{$value}%");
                    $q->orWhere('post_tags', 'LIKE', "%{$value}%");
                }
            });

            $posts = $posts->with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            $data = [
                'pageTitle' => 'Search Results for :: ' . $request->query('query'),
                'posts' => $posts,
                'query' => $query,
            ];

            return view('frontend.pages.search_posts', $data);
        } else {
            return abort(404);
        }
    }

    public function readPost($slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $post = Post::where('post_slug', $slug)
                ->with('subcategory')
                ->with('author')
                ->first();

            $post_tags = explode(',', $post->post_tags);
            $related_posts = Post::where('id', '!=', $post->id)->where(function ($q) use ($post_tags, $post) {
                foreach ($post_tags as $tag) {
                    $q->orWhere('post_tags', 'LIKE', "%{$tag}%")->orWhere('post_title', 'LIKE', $post->post_title);
                }
            })->inRandomOrder()->take(3)->get();

            $data = [
                'pageTitle' => Str::ucfirst($post->post_title),
                'post' => $post,
                'related_posts' => $related_posts,
            ];

            return view('frontend.pages.single_post', $data);
        }
    }

    public function tagPosts(Request $request, $tag)
    {
        if (!$tag) return abort(404);
        else {
            $posts = Post::where('post_tags', 'like', '%' . $tag . '%')
                ->with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            if (!$posts) {
                return abort(404);
            }

            $data = [
                'pageTitle' => '#' . $tag,
                'posts' => $posts,
                'tag' => $tag,
            ];

            return view('frontend.pages.tag_posts', $data);
        }
    }
}
