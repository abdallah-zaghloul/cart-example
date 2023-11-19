<?php

namespace Modules\User\Services\Web;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\User\Services\Base\WebConfirmPasswordService;

/**
 *
 */
class ConfirmPasswordService
{
    use WebConfirmPasswordService;

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function render(Request $request): JsonResponse|RedirectResponse
    {
        return $this->confirm($request);
    }
}
