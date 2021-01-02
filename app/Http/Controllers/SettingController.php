<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.list', compact('setting'));
    }

    public function update(SettingRequest $request, $id)
    {
        $setting = Setting::find($id);
        $setting->shipping_charge  = $request->shipping_charge;
        $setting->shopname  = $request->shopname;
        $setting->email  = $request->email;
        $setting->phone  = $request->phone;
        $setting->adderss  = $request->address;
        $setting->logo = $request->logo;
        $setting->save();
        $notification = [
            'message'=>'Successfully updated setting',
            'alert-type'=>'success'
        ];
        return redirect()->route('setting.list')->with($notification);
    }
}
