<?php
namespace App\Http\Repo\ProductRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
        $this->model->brand_id = $request->brand_id;
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

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();

            Image::make($image_one)->resize(300, 300)->save(storage_path().'/app/public/' . $image_one_name);
            $this->model->image_one = 'storage/' . $image_one_name;

            $image_two_name = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save(storage_path().'/app/public/' . $image_two_name);
            $this->model->image_two = 'storage/' . $image_two_name;


            $image_three_name = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save(storage_path().'/app/public/' . $image_three_name);
            $this->model->image_three = 'storage/' . $image_three_name;

            $this->model->save();


        }

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
        $obj->brand_id = $request->brand_id;
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

        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');
//        $image_one_store="";
//        $image_two_store="";
//        $image_three_store="";
        if($image_one)
        {
            $image_one_old=ltrim($old_one,'storage/');
            if (file_exists(storage_path().'/app/public/'.$image_one_old)) {
                unlink(storage_path().'/app/public/'.$image_one_old);
            }
            $image_one_name = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();

            Image::make($image_one)->resize(300, 300)->save(storage_path().'/app/public/' . $image_one_name);
            $obj->image_one= 'storage/' . $image_one_name;
        }
        if($image_two)
        {
            $image_two_old=ltrim($old_two,'storage/');
            if (file_exists(storage_path().'/app/public/'.$image_two_old)) {
                unlink(storage_path().'/app/public/'.$image_two_old);
            }
            $image_two_name = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();

            Image::make($image_two)->resize(300, 300)->save(storage_path().'/app/public/' . $image_two_name);
            $obj->image_two = 'storage/' . $image_two_name;
        }
        if($image_three)
        {
            $image_three_old=ltrim($old_three,'storage/');
            if (file_exists(storage_path().'/app/public/'.$image_three_old)) {
                unlink(storage_path().'/app/public/'.$image_three_old);
            }
            $image_three_name = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();

            Image::make($image_three)->resize(300, 300)->save(storage_path().'/app/public/' . $image_three_name);
            $obj->image_three= 'storage/' . $image_three_name;
        }


        $obj->save();

    }

    public function removeImage($obj)
    {
        $old_one = $obj->image_one;
        $old_two = $obj->image_two;
        $old_three = $obj->image_three;

        $image_one_delete=ltrim($old_one,'storage/');
        $image_two_delete=ltrim($old_two,'storage/');
        $image_three_delete=ltrim($old_three,'storage/');
        if (file_exists(storage_path().'/app/public/'.$image_one_delete)) {
            unlink(storage_path().'/app/public/'.$image_one_delete);
        }
        if (file_exists(storage_path().'/app/public/'.$image_two_delete)) {
            unlink(storage_path().'/app/public/'.$image_two_delete);
        }
        if (file_exists(storage_path().'/app/public/'.$image_three_delete)) {
            unlink(storage_path().'/app/public/'.$image_three_delete);
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


}
