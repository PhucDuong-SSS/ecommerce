<?php
namespace App\Http\Repo\ContactRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Contact;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
    public function store($request)
    {

        $this->model->name = $request->name;
        $this->model->email = $request->email;
        $this->model->phone = $request->phone;
        $this->model->message = $request->message;
        $this->model->save();
    }
}
