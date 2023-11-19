<?php

namespace Modules\User\Repositories;

use Modules\User\Models\Product;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\User\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace Modules\User\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
