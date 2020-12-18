<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repo\PostCategoryRepo\PostCategoryRepositoryInterface;

class PostCategoryController extends Controller
{
    private $postCategoryRepository;
    public function __construct(PostCategoryRepositoryInterface $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function index()
    {
        $postCategories = $this->postCategoryRepository->getAll();
        return view('admin.postCategory.list', compact('postCategories'));
    }

    public function showFormEdit($id)
    {
        $postCategory = $this->postCategoryRepository->findById($id);
        return view('admin.postCategory.edit', compact('postCategory'));
    }

    public function update(Request $request, $id)
    {
        $postCategory = $this->postCategoryRepository->findById($id);
        $this->postCategoryRepository->update($request,$postCategory);
        $notification = [
            'message'=>'Successfully updated post category',
            'alert-type'=>'success'
        ];
        return redirect()->route('postcategory.list')->with($notification);
    }


    public function store(Request $request)
    {
        $this->postCategoryRepository->create($request);
        $notification = [
            'message'=>'Successfully creted post category',
            'alert-type'=>'success'
        ];
        return redirect()->route('postcategory.list')->with($notification);
    }

    public function delete($id)
    {
        $this->postCategoryRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted coupon',
            'alert-type'=>'success'
        ];
        return redirect()->route('postcategory.list')->with($notification);
    }

}
