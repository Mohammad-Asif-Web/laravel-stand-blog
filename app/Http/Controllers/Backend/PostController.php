<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PhotoUploadController;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'subCategory', 'user')->latest()->paginate(5);
        return view ('backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->pluck('name','id')->all();
        $tags = Tag::where('status', 1)->select('id','name')->get();
        return view ('backend.modules.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        // request e jto gulo data asche segulo theke ai 3ta data bad dilam, karon eder kaj alada vabe kra hobe
        $post_data = $request->except(['tag_ids', 'photo','slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));   
        // je login kra ache, take ami pabo 'Auth' diye. 
        $post_data['user_id'] = Auth::user()->id;
        // je post krse se 'admin, naki 'user', naki 'moderator' seta dekhe post approve krbo.
        // tai akhon value 1 diye rakhlam, 1 = approve and 0 = not approve
        $post_data['is_approved'] = 1;

        // jdi 'photo' namer file thake tahle ai statement e dukba, na hoy drkar nai
        if($request->hasFile('photo')){
            // 'photo' ke $file er vetor store krlam
            $file = $request->file('photo');
            // photo take akta unique name dibo, tai 'slug' use krlam, kintu jdi multiple photo thake
            // tahle ai onno vabe nam dite hobe. karon ai name sob photo  thakte pare na.  
            // ai method sudhu single photor jnne, karon akti page e akbar e use hoy
            $name = Str::slug($request->input('slug'));
            // photor full version height width path
            $width = 1000;
            $height = 400;
            $path = 'images/original/';
            // photor thumbnail version height width path
            $thumb_width = 300;
            $thumb_height = 150;
            $thumb_path = 'images/thumbnail/';

            // imageUpload function theke 'name' return krtese, 
            // tai ai name $post_data['photo] te rakhar jnne 
            // puro function ke ai $post_dat['photo] te rakha hoise
            // imageUpload ke akti static function akare banano hoise.
            $post_data['photo'] =  PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));
        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Post Created Successfully');
        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user','category','subCategory','tag');
        return view ('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status', 1)->pluck('name','id')->all();
        $tags = Tag::where('status', 1)->select('id','name')->get();

                            // method 1: query builder fetch data
        // query builder diye data retrive krle time kom lage, fast kaj kore
        // sudhu jei data drkar setai ase, onno gula load hoy na
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)
                            ->pluck('tag_id', 'id')->toArray();

                            // method 2: eloquent fetch data
        // ata eloquent system, model er dhara avaveo data retrieve kra jay, 
        // but ata table er sob data load hoy avabe, 
        // tai query builder diye data retrive kra valo
        // $selected_tags = $post->tag->pluck('id')->toArray();

        return view ('backend.modules.post.edit', compact('post','categories', 'tags', 'selected_tags'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        // dd($request->all());
        $post_data = $request->except(['tag_ids', 'photo','slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));   
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;
        
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $width = 1000;
            $height = 400;
            $path = 'images/original/';

            // photor thumbnail version height width path
            $thumb_width = 300;
            $thumb_height = 150;
            $thumb_path = 'images/thumbnail/';

            // new image insert krte, jdi ager purno image thake, tahle seta remove hobe ai function e
            PhotoUploadController::imageUnlink($path, $post->photo);
            PhotoUploadController::imageUnlink($thumb_path, $post->photo);
            
            // then new photo abar upload hobe ai function e
            $post_data['photo'] =  PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }
        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));
        // flash message
        session()->flash('cls','success');
        session()->flash('msg', 'Post Updated Successfully');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $path = 'images/original/';
        $thumb_path = 'images/thumbnail/';
        PhotoUploadController::imageUnlink($path, $post->photo);
        PhotoUploadController::imageUnlink($thumb_path, $post->photo);
        $post->delete();

        // flash message
        session()->flash('cls','error');
        session()->flash('msg', 'Post Deleted Successfully');
        return redirect()->route('post.index');
    }
}
