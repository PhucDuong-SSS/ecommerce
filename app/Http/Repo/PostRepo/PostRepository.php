<?php
namespace App\Http\Repo\PostRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPostCategory()
    {
        $postCategory = PostCategory::all();
        return $postCategory;
    }

    public function store($request)
    {
        $this->model->post_title_en = $request->post_title_en;
        $this->model->post_title_vi = $request->post_title_vi;
        $this->model->post_category_id = $request->category_id;
        $this->model->details_en = $request->details_en;
        $this->model->details_vi = $request->details_vi;
        $post_image = $request->file('post_image');
        if($request->hasFile('post_image')){
            $pathImage = Storage::disk('s3')->put('images',$post_image,'public');
            $this->model->post_image = $pathImage;
            $this->model->save();
        }

    }
    public function update($request, $obj)
    {
        $obj->post_title_en = $request->post_title_en;
        $obj->post_title_vi = $request->post_title_vi;
        $obj->post_category_id = $request->category_id;
        $obj->details_en = $request->details_en;
        $obj->details_vi = $request->details_vi;
        $post_image = $request->file('post_image');
        $old_image = $obj->post_image;

        if($request->hasFile('post_image'))
        {
            $pathImage = Storage::disk('s3')->put('images',$post_image,'public');
            Storage::delete($old_image);
            $obj->post_image = $pathImage;
            $obj->save();
        }

    }

}
