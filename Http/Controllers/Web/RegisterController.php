<?php

namespace Modules\User\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\User\Services\Web\RegistrationService;
use Modules\User\Services\Web\ShowRegistrationFormService;

/**
 *
 */
class RegisterController extends Controller
{

    /**
     * @param ShowRegistrationFormService $service
     * @return Renderable
     */
    public function showRegistrationForm(ShowRegistrationFormService $service): Renderable
    {
        return $service->render();
    }


    /**
     * @param RegistrationService $service
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function register(RegistrationService $service, Request $request): JsonResponse|RedirectResponse
    {
        return $service->render($request);
    }
}
