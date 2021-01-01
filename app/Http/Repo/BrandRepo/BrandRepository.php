<?php
namespace App\Http\Repo\BrandRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function create($request)
    {
        $this->model->name = $request->brand_name;
        $image = $request->file('brand_logo');

        if($request->hasFile('brand_logo')){
            $pathImage = $request->file('brand_logo')->store('public/images');
            $pathImage = Storage::disk('s3')->put('images',$request->brand_logo,'public');
            $this->model->logo = $pathImage;
            $this->model->save();
        }
    }

    public function update($request, $obj)
    {
        $obj->name = $request->brand_name;
        $oldLogo = $obj->logo;

        if($request->hasFile('brand_logo')){
            $pathImage = Storage::disk('s3')->put('images',$request->brand_logo,'public');
            Storage::delete($oldLogo);
            $obj->logo = $pathImage;
            $obj->save();
        }

    }
}
