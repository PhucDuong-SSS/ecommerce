<?php

namespace App\Http\Controllers;

use App\Http\Repo\UserRepo\UserRepositoryInterface;
use App\Http\Repo\CategoryRepo\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
class CategoryController extends Controller
{

    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $categories = $this->categoryRepository->getAll();
        return view('admin.category.list', compact('categories'));

    }
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request);
        $notification = [
            'message'=>'Successfully create category',
            'alert-type'=>'success'
        ];
        return redirect()->route('category.list')->with($notification);
    }

    public function showFormEdit($id)
    {
        $category = $this->categoryRepository->findById($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update( CategoryRequest  $request, $id)
    {
        $category = $this->categoryRepository->findById($id);
        $this->categoryRepository->update($request, $category);
        $notification = [
            'message'=>'Successfully update category',
            'alert-type'=>'success'
        ];
        return redirect()->route('category.list')->with($notification);

    }
    public function delete($id)
    {
        $hasSubCategory = true;
        $category =$this->categoryRepository->findById($id);
        count($category->sub_categories)>0?$hasSubCategory = true:$hasSubCategory=false;
        if(!$hasSubCategory)
        {
            $this->categoryRepository->delete($id);
            $notification = [
                'message'=>'Successfully delete category',
                'alert-type'=>'success'
            ];
            return redirect()->route('category.list')->with($notification);
        }
        else
        {
            $notification = [
                'message'=>'You have to delete all sub category of this category to continue delete',
                'alert-type'=>'warning'
            ];
            return redirect()->route('category.list')->with($notification);
        }

    }
}
