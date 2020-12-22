<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Http\Repo\ContactRepo\ContactRepositoryInterface;

class ContactController extends Controller
{
    private $contactRepository;
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function showContactPage()
    {
        return view('page.contact');
    }
    public function storeInfo(ContactRequest $request)
    {
        $this->contactRepository->store($request);
        $notification = [
            'message'=>' Send successfully',
            'alert-type'=>'success'
        ];
        return Redirect()->route('contact.showContactPage')->with($notification);
    }
    public function getMessage()
    {
        $messages = $this->contactRepository->getAll();
        return view('admin.contact.showMessage', compact('messages'));
    }
    public function showDetail($id)
    {
        $message = $this->contactRepository->findById($id);
        return view('admin.contact.showdetails', compact('message'));
    }

}
