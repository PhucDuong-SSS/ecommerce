<?php

namespace App\Http\Controllers;

use App\Http\Repo\UserRepo\UserRepositoryInterface;
use App\Http\Repo\CategoryRepo\CategoryRepositoryInterface;
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
    public function store(Request $request)
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

    public function update( Request  $request, $id)
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
        $this->categoryRepository->delete($id);
        $notification = [
            'message'=>'Successfully delete category',
            'alert-type'=>'success'
        ];
        return redirect()->route('category.list')->with($notification);
    }
}
