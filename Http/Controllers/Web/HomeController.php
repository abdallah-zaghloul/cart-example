<?php

namespace Modules\User\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Services\Web\HomeService;

/**
 *
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param HomeService $service
     * @return Renderable
     */
    public function index(HomeService $service): Renderable
    {
        return $service->render();
    }
}
