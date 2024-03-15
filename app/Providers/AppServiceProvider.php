<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // $ProfileImage = User::with('profile')->get();
        $recent_posts = Post::where('is_approved', 1)->latest()->take(5)->get();
        $categories = Category::with('sub_categories')->where('status', 1)->orderBy('order_by', 'asc')->get();
        $tags = Tag::where('status', 1)->orderBy('order_by', 'asc')->get();
        View::share(['my_recent_posts'=>$recent_posts, 'my_categories' => $categories, 'my_tags' => $tags]);
    }
}
