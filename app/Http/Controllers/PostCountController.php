<?php

namespace App\Http\Controllers;

use App\Models\PostCount;

class PostCountController extends Controller
{

    /**
     * Display a listing of the resource.
     */

     private int $post_id;

     public function __construct(int $post_id)
     {
        $this->post_id = $post_id;
     }

    final public function postReadCount(): void
    {

        $post_count = PostCount::where('post_id', $this->post_id)->first();

        if ($post_count) {
            // up
            $post_count_data['count'] = $post_count->count + 1;
            $post_count->update($post_count_data);

        } else {
            $this->createPostCount();

        }

    }

    private function createPostCount():void
    {
        $post_count_data['post_id'] =  $this->post_id;
        $post_count_data['count'] = 1;
        PostCount::create($post_count_data);

    }






}



