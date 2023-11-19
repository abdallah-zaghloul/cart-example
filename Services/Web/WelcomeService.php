<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;

/**
 *
 */
class WelcomeService
{
    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user::welcome');
    }
}
