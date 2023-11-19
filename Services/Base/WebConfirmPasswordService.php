<?php

namespace Modules\User\Services\Base;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application as Foundation;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Modules\User\Providers\RouteServiceProvider;

/**
 *
 */
trait WebConfirmPasswordService
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Service
    |--------------------------------------------------------------------------
    |
    | This service is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;


    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * @return View|Application|Factory|Foundation
     */
    public function showConfirmForm(): View|Application|Factory|Foundation
    {
        return view('user::password-confirm');
    }
}
