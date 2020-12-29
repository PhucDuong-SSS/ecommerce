<?php
namespace App\Http\Repo\ProductRepo;

use App\Http\Repo\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function store($request);

    public function getCategory();

    public function getBrand();

    public function updateProduct($request, $obj);

    public function updateImageProduct($request, $obj);

    public function removeImage($obj);

    public function inactive($obj);

    public function active($obj);

    public function getFeaturedProduct();

    public function getTrendProduct();

    public function getHotProduct();

    public function getBestProduct();

    public function getBanner();

    public function buyOnegetOne();

    public function showProductCategory($id);

    public function getMainBanner();

    public function getsiteSetting();


}
