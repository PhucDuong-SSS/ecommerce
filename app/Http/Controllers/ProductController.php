<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Repo\ProductRepo\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
            return view('admin.product.list',compact('products'));
    }

    public function showCreateForm()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    public function getSubCategory($category_id)
    {
        $subCategory = DB::table('sub_categories')->where('category_id',$category_id)->get();
        return json_encode($subCategory);

    }

    public function store(ProductRequest $request)
    {
        $this->productRepository->store($request);
        $notification = [
            'message'=>'Successfully create product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function showFormEdit($id)
    {
        $brands = $this->productRepository->getBrand();
        $category =$this->productRepository->getCategory();
        $product = $this->productRepository->findById($id);
        return view('admin.product.edit',compact('product', 'category', 'brands'));
    }

    public function updateProduct(ProductRequest $request,$id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->updateProduct($request, $product);
        $notification = [
            'message'=>'Successfully updated product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function updateImageProduct(ProductRequest $request, $id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->updateImageProduct($request, $product);
        $notification = [
            'message'=>'Successfully updated image product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);


    }

    public function show($id)
    {
        $product = $this->productRepository->findById($id);
        return view('admin.product.show', compact('product'));
    }

    public function delete($id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->removeImage($product);
        $this->productRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);

    }
    public function active($id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->active($product);
        $notification = [
            'message'=>'Successfully active product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function inactive($id)
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->inactive($product);
        $notification = [
            'message'=>'Successfully inactive product',
            'alert-type'=>'success'
        ];
        return redirect()->back()->with($notification);

    }

    public function showProductFrontend()
    {
        $featuredProducts = $this->productRepository->getFeaturedProduct();
        $trendProducts = $this->productRepository->getTrendProduct();
        $hotProducts = $this->productRepository->getHotProduct();
        $bestProducts = $this->productRepository->getBestProduct();
        $categories = $this->productRepository->getCategory();
        $banner2 = $this->productRepository->getBanner();

        return view('page.layout.index',
            compact('featuredProducts','trendProducts','hotProducts','bestProducts','categories','banner2'));
    }





}
