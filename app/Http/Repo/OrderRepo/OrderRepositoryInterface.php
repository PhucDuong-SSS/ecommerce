<?php
namespace App\Http\Repo\OrderRepo;

use App\Http\Repo\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getOrderByStatus($status);

    public function getDetails($id);

    public function changeStatus($obj, $status);

    public function subQuantity($id);
}
