<?php
namespace App\Http\Repo\CategoryRepo;


use App\Http\Repo\BaseRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $request
     */
  public function create($request)
  {
      $this->model->name = $request->category_name;
      $this->model->save();
  }
  public function update($request, $obj)
  {
      $obj->name = $request->category_name;
      $obj->save();
  }

}
