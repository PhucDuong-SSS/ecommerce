<?php
namespace App\Http\Repo;

use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    public function getAll();

    public function findById(int $id);

    public function delete($id);
}
