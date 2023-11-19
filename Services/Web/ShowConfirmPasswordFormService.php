<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Modules\User\Services\Base\WebConfirmPasswordService;

/**
 *
 */
class ShowConfirmPasswordFormService
{
    use WebConfirmPasswordService;

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return $this->showConfirmForm();
    }
}
