<?php
namespace App\Http\Repo\CustomerRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Customer;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function create($request)
    {
        $this->model->name =  $request->name;
        $this->model->username =  $request->username;
        $this->model->phone =  $request->phone;
        $this->model->email =  $request->email;
        $this->model->avatar = "";
        $this->model->provider = "";
        $this->model->provider_id = "";
        $this->model->password = bcrypt($request->password);
        $this->model->save();
    }
}
