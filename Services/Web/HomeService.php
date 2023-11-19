<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;


/**
 *
 */
class HomeService
{
    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user::home');
    }
}
