<?php

namespace Modules\User\Services\Web;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\User\Services\Base\WebVerificationService;

/**
 *
 */
class VerifyEmailService
{
    use WebVerificationService;

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws AuthorizationException
     */
    public function render(Request $request): JsonResponse|RedirectResponse
    {
        return $this->verify($request);
    }
}
