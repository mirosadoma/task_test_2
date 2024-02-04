<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Http\Requests\Api\Posts\StoreRequest;
use App\Http\Requests\Api\Posts\UpdateRequest;
use App\Http\Resources\Api\PostsCollections;
// Resources
use App\Http\Resources\Api\PostsResources;
// Models
use App\Models\Addressess\Address;
use App\Models\Post;
use App\Support\API;
use App\Support\Image;

class PostsController extends Controller
{
    public function view_my_posts(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate();
        return (new API)
            ->isOk(__('Posts Data'))
            ->setData(PostsResources::collection($posts))
            ->addAttribute("paginate",api_model_set_paginate($posts))
            ->build();
    }

    public function view_all_posts(){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $posts = Post::orderBy('created_at', 'desc')->paginate();
        return (new API)
            ->isOk(__('Posts Data'))
            ->setData(PostsResources::collection($posts))
            ->addAttribute("paginate",api_model_set_paginate($posts))
            ->build();
    }

    public function show_post(Post $post){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if (!$post) {
            return (new API)
                ->isError(__('Post Not Found'))
                ->build();
        }
        return (new API)
            ->isOk(__('Post Informations'))
            ->setData(new PostsCollections($post))
            ->build();
    }

    public function add_post(StoreRequest $request){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        $data = $request->all();
        $data['user'] = $user->id;
        if (request()->has('image') && $request->image != NULL) {
            $data['image'] = (new Image)->FileUpload($request->image, "posts");
        }
        $post = $user->posts()->create($data);
        return (new API)
            ->isOk(__('Data Saved Successfully'))
            ->setData(new PostsResources($post))
            ->build();
    }

    public function update_post(UpdateRequest $request, Post $post){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        if (!$post) {
            return (new API)
                ->isError(__('Post Not Found'))
                ->build();
        }
        $data = $request->all();
        if (request()->has('image') && $request->image != NULL) {
            $data['image']      = (new Image)->FileUpload($request->image, 'posts', true, $post->image);
        }else{
            unset($data['image']);
        }

        $post->update($data);
        return (new API)
            ->isOk(__('Data Updated Successfully'))
            ->setData(new PostsResources($post))
            ->build();
    }

    public function delete_post(Request $request, Post $post){
        $user = Auth::guard('api')->user();
        if (!$user) {
            return (new API)
                ->isError(__('Please Login First'))
                ->build();
        }
        (new Image)->DeleteImage($post->image);
        $post->delete();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate();
        return (new API)
            ->isOk(__('Data Deleted Successfully'))
            ->setData(PostsResources::collection($posts))
            ->build();
    }
}
