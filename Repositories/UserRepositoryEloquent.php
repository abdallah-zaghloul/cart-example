<?php

namespace Modules\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\User\Criteria\RequestCriteria;
use Modules\User\Repositories\UserRepository;
use Modules\User\Models\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace Modules\User\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
