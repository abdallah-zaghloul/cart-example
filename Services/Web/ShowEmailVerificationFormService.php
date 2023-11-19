<?php

namespace Modules\User\Services\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Services\Base\WebVerificationService;

/**
 *
 */
class ShowEmailVerificationFormService
{
    use WebVerificationService;

    /**
     * @param Request $request
     * @return Renderable
     */
    public function render(Request $request): Renderable
    {
        return $this->show($request);
    }
}
