<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Repo\ProductRepo\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\isEmpty;

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

    public function updateImage(ProductRequest $request, $id)
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
        $has_order_details = true;
        $has_wishlist = true;
        $product = $this->productRepository->findById($id);
        isEmpty($product->wishlist)?$has_wishlist = true:$has_wishlist=false;
        isEmpty($product->orderdetail)?$has_order_details = true:$has_order_details=false;

        if(!$has_order_details && !$has_wishlist )
        {
            $this->productRepository->removeImage($product);
            $this->productRepository->delete($id);
            $notification = [
                'message'=>'Successfully deleted product',
                'alert-type'=>'success'
            ];
            return redirect()->back()->with($notification);
        }
        else
        {
            $notification = [
                'message'=>'Proudct belong to wishlist, order details table',
                'alert-type'=>'warning'
            ];
            return redirect()->route('product.list')->with($notification);
        }



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
        $mainBaner = $this->productRepository->getMainBanner();
        $siteSetting = $this->productRepository->getsiteSetting();

        return view('page.layout.index',
            compact('mainBaner','featuredProducts','trendProducts','hotProducts','bestProducts','categories','banner2','siteSetting'));
    }

    public function getProductStock()
    {
        $products = $this->productRepository->getAll();
        return view('admin.stock.stockProduct', compact('products'));
    }
    public function showDetails($id)
    {
        $product = $this->productRepository->findById($id);
        $color = $product->color;
        $product_color = explode(',', $color);
        return view('page.product', compact('product','product_color'));
    }

    public function showProductCategory($id)
    {
        $productsCategory = $this->productRepository->showProductCategory($id);
        $brands = $this->productRepository->getBrand();
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','brands'));
    }

    public function renderProductView(Request $request)
    {
        if($request->ajax())
        {
            $listId = $request->id;
            $products = Product::whereIn('id',$listId)->get();
            $html = view('components.recentlyView',compact('products'))->render();

            return response()->json(['data'=>$html]);
        }
    }



}
