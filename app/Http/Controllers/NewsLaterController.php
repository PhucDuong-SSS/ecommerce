<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repo\NewsLaterRepo\NewsLaterRepositoryInterface;

class NewsLaterController extends Controller
{
    private $newLaterRepository;
    public function __construct(NewsLaterRepositoryInterface $newLaterRepository)
    {
        $this->newLaterRepository = $newLaterRepository;
    }

    public function index()
    {
        $newsLaters = $this->newLaterRepository->getAll();

        return view('admin.newslater.list', compact('newsLaters'));

    }

    public function delete($id)
    {
        $this->newLaterRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted newslater',
            'alert-type'=>'success'
        ];
        return redirect()->route('newslater.list')->with($notification);

    }

}
