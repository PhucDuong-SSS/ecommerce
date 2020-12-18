<?php
namespace App\Http\Repo\PostCategoryRepo ;

use App\Http\Repo\BaseRepository;
use App\Models\PostCategory;

class PostCategoryRepository extends BaseRepository implements PostCategoryRepositoryInterface
{
    public function __construct(PostCategory $model)
    {
        parent::__construct($model);
    }

    public function create($request)
    {
        $this->model->category_name_en = $request->category_name_en;
        $this->model->category_name_vi = $request->category_name_vi;
        $this->model->save();
    }

    public function update($request, $obj)
    {
        $obj->category_name_en = $request->category_name_en;
        $obj->category_name_vi = $request->category_name_vi;
        $obj->save();
    }

}
