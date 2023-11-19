<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Modules\User\Services\Base\WebRegistrationService;

/**
 *
 */
class ShowRegistrationFormService
{
    use WebRegistrationService;

    /**
     * @return Renderable
     */
    public function render(): Renderable
    {
        return $this->showRegistrationForm();
    }
}
