<?php

namespace Modules\User\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\User\Services\Web\ConfirmPasswordService;
use Modules\User\Services\Web\ShowConfirmPasswordFormService;

/**
 *
 */
class ConfirmPasswordController extends Controller
{

    /**
     * @param ShowConfirmPasswordFormService $service
     * @return Renderable
     */
    public function showConfirmForm(ShowConfirmPasswordFormService $service): Renderable
    {
        return $service->render();
    }

    /**
     * @param ConfirmPasswordService $service
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function confirm(ConfirmPasswordService $service, Request $request): JsonResponse|RedirectResponse
    {
        return $service->render($request);
    }
}
