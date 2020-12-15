<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Repo\SubCategoryRepo\SubCategoryRepositoryInterface;
class SubCategoryController extends Controller
{
    private $subCategoryRepository;
    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index()
    {
        $subCategorys = $this->subCategoryRepository->getAll();
        $categoryList = Category::all();
        return view('admin.subCategory.list', compact('subCategorys','categoryList'));
    }

    public function showFormEdit($id)
    {   $categoryList = Category::all();
        $subCategory =$this->subCategoryRepository->findById($id);
        return view('admin.subCategory.edit',compact('subCategory','categoryList'));
    }
    public function store(SubCategoryRequest $request)
    {
        $this->subCategoryRepository->create($request);
        $notification = [
            'message'=>'Successfully created sub-category',
            'alert-type'=>'success'
        ];
        return redirect()->route('subcategory.list')->with($notification);
    }
    public function update(SubCategoryRequest $request, $id)
    {
        $subCategory = $this->subCategoryRepository->findById($id);
        $this->subCategoryRepository->update($request, $subCategory);
        $notification = [
            'message'=>'Successfully updated sub-category',
            'alert-type'=>'success'
        ];
        return redirect()->route('subcategory.list')->with($notification);

    }
    public function delete($id)
    {
        $this->subCategoryRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted sub-category',
            'alert-type'=>'success'
        ];
        return redirect()->route('subcategory.list')->with($notification);
    }





}
