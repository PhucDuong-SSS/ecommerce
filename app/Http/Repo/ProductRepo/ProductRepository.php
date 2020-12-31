<?php
namespace App\Http\Repo\ProductRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function store($request)
    {
        $this->model->name = $request->product_name;
        $this->model->code = $request->product_code;
        $this->model->quantity = $request->product_quantity;
        $this->model->discount_price = $request->discount_price;
        $this->model->category_id = $request->category_id;
        $this->model->sub_category_id = $request->subcategory_id;
//        $this->model->brand_id = $request->brand_id;
        $this->model->size = $request->product_size;
        $this->model->color = $request->product_color;
        $this->model->selling_price = $request->selling_price;
        $this->model->details = $request->product_details;
        $this->model->video_link = $request->video_link;
        $this->model->main_slider = $request->main_slider;
        $this->model->hot_deal = $request->hot_deal;
        $this->model->best_rated = $request->best_rated;
        $this->model->trend = $request->trend;
        $this->model->mid_slider = $request->mid_slider;
        $this->model->hot_new = $request->hot_new;
        $this->model->buyone_getone = $request->buyone_getone;
        $this->model->status = 1;

        if($request->hasFile('image_one')){
            $pathImage = $request->file('image_one')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_one,'public');
            $this->model->image_one = $pathImage;
        }
        if($request->hasFile('image_two')){
            $pathImage = $request->file('image_one')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_two,'public');
            $this->model->image_two = $pathImage;
        }
        if($request->hasFile('image_three')){
            $pathImage = $request->file('image_three')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_three,'public');
            $this->model->image_three = $pathImage;
        }
        $this->model->save();


    }


    public function getCategory()
    {
        $category = Category::all();
        return $category;
    }

    public function getBrand()
    {
        $bands = Brand::all();
        return $bands;
    }

    public function updateProduct($request, $obj)
    {
        $obj->name = $request->product_name;
        $obj->code = $request->product_code;
        $obj->quantity = $request->product_quantity;
        $obj->discount_price = $request->discount_price;
        $obj->category_id = $request->category_id;
        $obj->sub_category_id = $request->subcategory_id;
//        $obj->brand_id = $request->brand_id;
        $obj->size = $request->product_size;
        $obj->color = $request->product_color;
        $obj->selling_price = $request->selling_price;
        $obj->details = $request->product_details;
        $obj->video_link = $request->video_link;
        $obj->main_slider = $request->main_slider;
        $obj->hot_deal = $request->hot_deal;
        $obj->best_rated = $request->best_rated;
        $obj->trend = $request->trend;
        $obj->mid_slider = $request->mid_slider;
        $obj->hot_new = $request->hot_new;
        $obj->buyone_getone = $request->buyone_getone;
        $obj->save();

    }

    public function updateImageProduct($request, $obj)
    {

        $old_one = $obj->image_one;
        $old_two = $obj->image_two;
        $old_three = $obj->image_three;

        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if($request->hasFile('image_one')){
            $pathImage = $request->file('image_one')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_one,'public');

            Storage::delete($old_one);
            $obj->image_one = $pathImage;
            $obj->save();
        }
        if($request->hasFile('image_two')){
            $pathImage = $request->file('image_two')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_two,'public');

            Storage::delete($old_two);
            $obj->image_two = $pathImage;
            $obj->save();
        }
        if($request->hasFile('image_three')){
            $pathImage = $request->file('image_three')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->image_three,'public');

            Storage::delete($old_three);
            $obj->image_three = $pathImage;
            $obj->save();
        }

    }


    public function inactive($obj)
    {
        $obj->status = 0;
        $obj->save();
    }

    public function active($obj)
    {
        $obj->status = 1;
        $obj->save();

    }

    public function getFeaturedProduct()
    {
        $featuredProducts =$this->model->where('status',1)->orderBy('id','desc')->limit(12)->get();
        return $featuredProducts;
    }

    public function getTrendProduct()
    {
        $trendProducts =$this->model->where('status',1)->where('trend',1)->orderBy('id','desc')->limit(8)->get();
        return $trendProducts;
    }

    public function getHotProduct()
    {
        $hotProducts =$this->model->where('status',1)->where('hot_deal',1)->orderBy('id','desc')->limit(3)->get();
        return $hotProducts;

    }

    public function getBestProduct()
    {
        $bestProducts =$this->model->where('status',1)->where('best_rated',1)->orderBy('id','desc')->limit(8)->get();
        return $bestProducts;

    }
    public function getBanner()
    {
        $banners =$this->model->where('status',1)->where('mid_slider',1)->orderBy('id','desc')->limit(3)->get();
        return $banners;
    }

    public function buyOnegetOne()
    {
        $getOne =$this->model->where('status',1)->where('buyone_getone',1)->orderBy('id','desc')->limit(6)->get();
        return $getOne;
    }

    public function showProductCategory($id)
    {

        return $this->model->where('category_id',$id)->paginate(8);
    }
    public function getMainBanner()
    {
        return $this->model->where('status',1)->where('main_slider',1)->first();
    }
    public function getsiteSetting()
    {
        $siteSetting = DB::table('site_settings')->get();
        return $siteSetting;
    }

    public function showProductCategoryFeature($categoryId)
    {
        return $this->model->where('category_id',$categoryId)->where('status',1)->where('hot_deal',1)->paginate(8);
    }
    public function showProductCategoryTrend($categoryId)
    {
        return $this->model->where('category_id',$categoryId)->where('status',1)->where('trend',1)->paginate(8);
    }
    public function showProductCategoryView($categoryId)
    {
        return $this->model->where('category_id',$categoryId)->where('status',1)->orderBy('view', 'desc')->paginate(8);
    }
    public function showProductCategoryPriceAsc($categoryId)
    {
        return $this->model->where('category_id',$categoryId)->where('status',1)->orderBy('selling_price', 'asc')->paginate(8);
    }
    public function showProductCategoryPriceDecs($categoryId)
    {
        return $this->model->where('category_id',$categoryId)->where('status',1)->orderBy('selling_price', 'desc')->paginate(8);
    }

    public function showProductSubCategory($id)
    {

        return $this->model->where('sub_category_id',$id)->where('status',1)->paginate(8);
    }
    public function showProductSubCategoryFeature($subcategoryId)
    {
        return $this->model->where('sub_category_id',$subcategoryId)->where('hot_deal',1)->where('status',1)->paginate(8);
    }
    public function showProductSubCategoryTrend($subcategoryId)
    {
        return $this->model->where('sub_category_id',$subcategoryId)->where('trend',1)->where('status',1)->paginate(8);
    }
    public function showProductSubCategoryView($subcategoryId)
    {
        return $this->model->where('sub_category_id',$subcategoryId)->where('status',1)->orderBy('view', 'desc')->paginate(8);
    }
    public function showProductSubCategoryPriceAsc($subcategoryId)
    {
        return $this->model->where('sub_category_id',$subcategoryId)->where('status',1)->orderBy('selling_price', 'asc')->paginate(8);
    }
    public function showProductSubCategoryPriceDecs($subcategoryId)
    {
        return $this->model->where('sub_category_id',$subcategoryId)->where('status',1)->orderBy('selling_price', 'desc')->paginate(8);
    }
    public function searchProduct($request)
    {
        $search = $request->search;
        return $this->model->where('name', 'like','%'.$search.'%' )->where('status',1)->paginate(8);

    }


}
