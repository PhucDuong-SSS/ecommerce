<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use App\Http\Repo\BrandRepo\BrandRepositoryInterface;

class BrandController extends Controller
{
    private $brandRepository;
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brandRepository->getAll();
        return view('admin.branch.list', compact('brands'));
    }

    public function store(Request $request)
    {
        $this->brandRepository->create($request);
        $notification = [
            'message'=>'Successfully create brand',
            'alert-type'=>'success'
        ];
        return redirect()->route('brand.list')->with($notification);
    }

    public function update(BrandRequest $request, $id)
    {
        $brand = $this->brandRepository->findById($id);
        $this->brandRepository->update($request, $brand);
        $notification = [
            'message'=>'Successfully updated brand',
            'alert-type'=>'success'
        ];
        return redirect()->route('brand.list')->with($notification);
    }

    public function showFormEdit($id)
    {
        $brand = $this->brandRepository->findById($id);
        return view('admin.branch.edit', compact('brand'));
    }

    public function delete($id)
    {
        $brand = $this->brandRepository->findById($id);
        unlink($brand->logo);
    $this->brandRepository->delete($id);
    $notification = [
        'message'=>'Successfully deleted brand',
        'alert-type'=>'success'
    ];
    return redirect()->route('brand.list')->with($notification);
    }
}
