<?php
namespace App\Http\Repo\PostRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Post;
use App\Models\PostCategory;
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
        if ($post_image) {
            $image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();

            Image::make($post_image)->resize(400, 200)->save(storage_path() . '/app/public/' . $image_name);
            $this->model->post_image = 'storage/' . $image_name;
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

        if ($post_image) {
            $image_old_move=ltrim($old_image,'storage/');
            if (file_exists(storage_path().'/app/public/'.$image_old_move))
            {
                unlink(storage_path().'/app/public/'.$image_old_move);
            }

            $image_name = hexdec(uniqid()) . '.' . $post_image->getClientOriginalExtension();

            Image::make($post_image)->resize(400, 200)->save(storage_path() . '/app/public/' . $image_name);
            $obj->post_image = 'storage/' . $image_name;

        }
        $obj->save();

    }

    public function removeImage($obj)
    {
        $old_image = $obj->post_image;
        $image_old_move=ltrim($old_image,'storage/');
        if (file_exists(storage_path().'/app/public/'.$image_old_move))
        {
            unlink(storage_path().'/app/public/'.$image_old_move);
        }

    }
}
