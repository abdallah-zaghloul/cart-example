<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Modules\User\Services\Base\WebAuthenticationService;

/**
 *
 */
class ShowLoginFormService
{
    use WebAuthenticationService;

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user::login');
    }
}
