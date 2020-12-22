<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repo\WishlistRepo\WishlistRepositoryInterface;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    private $wishlistRepository;
    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }
    public function addWishlist($id)
    {
        $count = $this->wishlistRepository->count();

        $check = $this->wishlistRepository->check($id);

        $checkLogin = $this->wishlistRepository->checkLogin();


        if ($checkLogin)
        {

            if ($check)
            {
                return \Response::json(['error' => 'Product Already Has on your wishlist']);
            }
            else
               {
                  $this->wishlistRepository->store($id);
                  $count++;
                  Session::put('count',$count);
                 return \Response::json(['success' => 'Product Added on wishlist','count'=>$count]);

              }
        }
        else
            {
            return \Response::json(['error' => 'At first login your account']);

          }

    }

}
