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
use Illuminate\Support\Facades\Storage;
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

        if($has_order_details && $has_wishlist )
        {
            $product = $this->productRepository->findById($id);
            Storage::delete($product->image_one);
            Storage::delete($product->image_two);
            Storage::delete($product->image_three);
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
        $categories= Category::all();
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
        $siteSetting = $this->productRepository->getsiteSetting();
        $categories= Category::all();

        $product = $this->productRepository->findById($id);
        $this->productRepository->plusView($product);
        $categoryId = $product->category->id;
        $productRelated  = Product::where('category_id',$categoryId)->limit(4)->get();
        $color = $product->color;
        $product_color = explode(',', $color);
        return view('page.product', compact('product','product_color','siteSetting','categories','productRelated'));
    }

    public function showProductCategory($id)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategory($id);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));
    }

    public function showProductCategoryFeature($categoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategoryFeature($categoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));

    }

    public function showProductCategoryTrend($categoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategoryTrend($categoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductCategoryView($categoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategoryView($categoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductCategoryPriceDecs($categoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategoryPriceDecs($categoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductCategoryPriceAsc($categoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductCategoryPriceAsc($categoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.shop', compact('productsCategory','categories','siteSetting'));

    }
    //show proddut sub
    public function showProductSubCategory($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

    }
    //
    public function showProductSubCategoryFeature($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductSubCategoryTrend($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductSubCategoryView($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductSubCategoryPriceAsc($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

    }
    public function showProductSubCategoryPriceDecs($subcategoryId)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $productsCategory = $this->productRepository->showProductSubCategory($subcategoryId);
        $categories = $this->productRepository->getCategory();
        return view('page.subcategory', compact('productsCategory','categories','siteSetting'));

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

    public function searchProduct(Request $request)
    {
        $siteSetting = $this->productRepository->getsiteSetting();
        $keyword = $request->search;
        $categories = $this->productRepository->getCategory();
        $searchProducts = $this->productRepository->searchProduct($request);
        return view('page.search',compact('siteSetting','categories','searchProducts','keyword'));


    }



}
