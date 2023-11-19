<?php

namespace Modules\User\Services\Web;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Services\Base\WebRegistrationService;

/**
 *
 */
class RegistrationService
{
    use WebRegistrationService;

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Response
     */
    public function render(Request $request): JsonResponse|RedirectResponse|Response
    {
        return $this->register($request);
    }
}
