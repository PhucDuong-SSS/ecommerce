<?php
namespace App\Http\Repo\BrandRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Brand;

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
        if($image)
        {
            $filename = pathinfo($image, PATHINFO_FILENAME);
            $imageName = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $imageFullName = $imageName.$filename.'.'.$ext;
            $uploadPath = 'public/media/brand/';
            $image_url = $uploadPath.$imageFullName;
            $success = $image->move($uploadPath,$imageFullName);
            $this->model->logo = $image_url;
            $this->model->save();
        }
    }

    public function update($request, $obj)
    {
        $obj->name = $request->brand_name;
        $oldLogo = $request->old_logo;
        $image = $request->file('brand_logo');
        if($image)
        {
            unlink($oldLogo);
            $filename = pathinfo($image, PATHINFO_FILENAME);
            $imageName = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $imageFullName = $imageName.$filename.'.'.$ext;
            $uploadPath = 'public/media/brand/';
            $image_url = $uploadPath.$imageFullName;
            $success = $image->move($uploadPath,$imageFullName);
            $obj->logo = $image_url;
            $obj->save();
        }

    }
}
