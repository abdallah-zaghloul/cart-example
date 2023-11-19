<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Modules\User\Services\Base\WebForgotPasswordService;

/**
 *
 */
class ShowForgotPasswordLinkFormService
{
    use WebForgotPasswordService;

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return $this->showLinkRequestForm();
    }
}
