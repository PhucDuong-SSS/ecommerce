<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
//    private $categoryRepository;
//    public function __construct(CategoryRepositoryInterface $categoryRepository)
//    {
//        $this->categoryRepository = $categoryRepository;
//    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));

    }

    public function edit($id)
    {
        $category = $this->categoryRepository->findById($id);
        //retu
    }
}
