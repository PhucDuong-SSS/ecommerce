<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Http\Repo\PostRepo\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAll();
        return view('admin.post.list', compact('posts'));
    }

    public function showFormCreate()
    {
        $postCategory = $this->postRepository->getPostCategory();
        return view('admin.post.create', compact('postCategory'));
    }

    public function showFormEdit($id)
    {
        $postCategory = $this->postRepository->getPostCategory();
        $post = $this->postRepository->findById($id);
        return view('admin.post.edit', compact('postCategory', 'post'));
    }


    public function store(PostRequest $request)
    {
        $this->postRepository->store($request);
        $notification = [
            'message'=>'Successfully created post',
            'alert-type'=>'success'
        ];
        return redirect()->route('post.list')->with($notification);
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->postRepository->findById($id);
        $this->postRepository->update($request, $post);
        $notification = [
            'message'=>'Successfully updated post',
            'alert-type'=>'success'
        ];
        return redirect()->route('post.list')->with($notification);

    }
    public function delete($id)
    {
        $post = $this->postRepository->findById($id);
        Storage::delete($post->post_image);
        $this->postRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted post',
            'alert-type'=>'success'
        ];
        return redirect()->route('post.list')->with($notification);

    }

}
