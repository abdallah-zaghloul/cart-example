<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Services\Base\WebResetPasswordService;

/**
 *
 */
class ResetPasswordFormService
{
    use WebResetPasswordService;

    /**
     * @param Request $request
     * @return Renderable
     */
    public function render(Request $request): Renderable
    {
        return $this->showResetForm($request);
    }
}
