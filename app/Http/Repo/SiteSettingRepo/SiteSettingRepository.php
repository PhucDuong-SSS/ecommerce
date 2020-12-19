<?php
namespace App\Http\Repo\SiteSettingRepo;

use App\Http\Repo\BaseRepository;
use App\Models\SiteSetting;

class  SiteSettingRepository extends BaseRepository implements SiteSettingRepositoryInterface
{
    public function __construct(SiteSetting $model)
    {
        parent::__construct($model);
    }


    public function update($request, $obj)
    {
        $obj->phone_one = $request->phone_one;
        $obj->phone_two = $request->phone_two;
        $obj->email = $request->email;
        $obj->company_name = $request->company_name;
        $obj->company_address = $request->company_address;
        $obj->facebook = $request->facebook;
        $obj->youtube = $request->youtube;
        $obj->instagram = $request->instagram;
        $obj->twitter = $request->twitter;
        $obj->save();
    }
}
