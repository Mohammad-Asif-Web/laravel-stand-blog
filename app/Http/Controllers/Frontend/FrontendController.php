<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCountController;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('category','subCategory','tag','user')->where('is_approved',1)->where('status',1);
        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(5)->get();
        return view('frontend.modules.index', compact('posts', 'slider_posts'));
    }

    public function all_posts()
    {
        $sub_title = 'View Blogs';
        $title = 'All Blog Post';
        $all_posts = Post::with('category','subCategory','tag','user')
        ->where('is_approved',1)->where('status',1)
        ->latest()->paginate(6);
        return view('frontend.modules.all_posts', compact('all_posts', 'sub_title', 'title'));
    }

    public function search(Request $request)
    {
        $sub_title = 'Search Result';
        $title = $request->input('search');
        $searchData = $request->input('search');
        $all_posts = Post::with('category','subCategory','tag','user')
        ->where('is_approved',1)->where('status',1)
        ->where('title', 'like', '%'.$searchData.'%')
        ->latest()->paginate(5);
        return view('frontend.modules.all_posts', compact('all_posts', 'sub_title', 'title'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $all_posts = Post::with('category','subCategory','tag','user')
        ->where('is_approved',1)->where('status',1)
        ->where('category_id', $category->id)
        ->latest()->paginate(5);

        $sub_title = 'Post by Category';
        $title = $category->name;
        return view('frontend.modules.all_posts', compact('all_posts', 'sub_title', 'title'));
    }

    public function sub_category($slug, $sub_slug )
    {
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        $all_posts = Post::with('category','subCategory','tag','user')
        ->where('is_approved',1)->where('status',1)
        ->where('sub_category_id', $sub_category->id)
        ->latest()->paginate(5);

        $sub_title = 'Post by Sub Category';
        $title = $sub_category->name;
        return view('frontend.modules.all_posts', compact('all_posts', 'sub_title', 'title'));
    }

    public function tag($slug)
    {
        // distinct = minimize the duplicate record
        // whereIn = accepts array data
        $tag = Tag::where('slug', $slug)->first();
        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)
                        ->distinct('post_id')->pluck('post_id');
        // dd($post_ids);
        $all_posts = Post::with('category','subCategory','tag','user')
                        ->where('is_approved',1)->where('status',1)
                        ->whereIn('id', $post_ids)
                        ->latest()->paginate(5);

        $sub_title = 'Post by Tag';
        $title = $tag->name;
        return view('frontend.modules.all_posts', compact('all_posts', 'sub_title', 'title'));
    }

    public function single($slug)
    {
        $post = Post::with('category', 'subCategory', 'tag', 'user', 'comment', 'comment.user')
                    ->where('is_approved',1)->where('status',1)
                    ->where('slug', $slug)
                    ->firstOrFail();

        $sub_title = 'Post Details';
        $title = $post->title;
        return view('frontend.modules.single', compact('post', 'sub_title', 'title'));
    }


    final public function postReadCount($post_id): void
    {
        // jdi class er multiple methods and properties call krte hoy, tahle aivabe call kra jay.
        // atai good practice class er multiple data niye kaj krte
        $post_count = new PostCountController($post_id);
        $post_count->postReadCount();

        // jdi class er shudhu 1ti method ke use krte hoy, tahle ai vabe akbar method ke call kra jay
        // (new PostCountController($post_id))->postReadCount();
    }

    final public function about()
    {
        return view('frontend.modules.about');
    }

    // 'final' keyword use for, this is method can not be override in future
    final public function contact()
    {
        return view('frontend.modules.contact');
    }
}
