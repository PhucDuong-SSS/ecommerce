<?php
namespace App\Http\Repo\NewsLaterRepo;
use App\Http\Repo\BaseRepository;
use App\Models\NewLater;

class NewsLaterRepository extends BaseRepository implements NewsLaterRepositoryInterface
{
    public function __construct(NewLater $model)
    {
        parent::__construct($model);
    }
}
