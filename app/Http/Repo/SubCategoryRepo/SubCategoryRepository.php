<?php
namespace App\Http\Repo\SubCategoryRepo;

use App\Http\Repo\BaseRepository;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
    }

    public function create($request)
    {
        $this->model->name = $request->subcategory_name;
        $this->model->category_id = $request->category_id;
        $this->model->save();
    }

    public function update($request, $obj)
    {
        $obj->name = $request->subcategory_name;
        $obj->category_id = $request->category_id;
        $obj->save();
    }
}
