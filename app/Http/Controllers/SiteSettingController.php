<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Repo\SiteSettingRepo\SiteSettingRepositoryInterface;

class SiteSettingController extends Controller
{
    private $siteSettingRepository;

    public function __construct(SiteSettingRepositoryInterface $siteSettingRepository)
    {
        $this->siteSettingRepository = $siteSettingRepository;
    }

    public function index()
    {
        $setting = SiteSetting::first();
        return view('admin.siteSetting.list', compact('setting'));
    }

    public function update(SiteSettingRequest $request, $id)
    {
        $siteSetting =$this->siteSettingRepository->findById($id);
        $this->siteSettingRepository->update($request, $siteSetting);
        $notification = [
            'message'=>'Successfully updated site setting',
            'alert-type'=>'success'
        ];
        return redirect()->route('siteSetting.list')->with($notification);
    }

}
