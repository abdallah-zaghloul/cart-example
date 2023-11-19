<?php

namespace Modules\User\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\User\Services\Web\WelcomeService;

/**
 *
 */
class WelcomeController extends Controller
{

    /**
     * @param WelcomeService $service
     * @return Renderable
     */
    public function __invoke(WelcomeService $service): Renderable
    {
        return $service->render();
    }
}
