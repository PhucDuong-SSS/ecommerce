<?php


namespace App\Http\Repo\UserRepo;


use App\Http\Repo\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAdminByType($type);

    public function store($request);

    public function update($obj, $request );

    public function getTotalofDay($date);
    public function getTotalofMonth($month);
    public function getTotalofYear($year);
    public function getDeliveryThisDay($date);
    public function getOrderReturn();
    public function getProduct();
    public function getBranch();
    public function getCustomer();



}
