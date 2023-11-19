<?php

namespace Modules\User\Services\Base;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application as Foundation;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Modules\User\Providers\RouteServiceProvider;

/**
 *
 */
trait WebResetPasswordService
{
    /*
     |--------------------------------------------------------------------------
     | Password Reset Service
     |--------------------------------------------------------------------------
     |
     | This service is responsible for handling password reset requests
     | and uses a simple trait to include this behavior. You're free to
     | explore this trait and override any methods you wish to tweak.
     |
     */

    use ResetsPasswords;


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * @param Request $request
     * @return View|Application|Factory|Foundation
     */
    public function showResetForm(Request $request):  View|Application|Factory|Foundation
    {
        $token = $request->route()->parameter('token');

        return view('user::password-reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }
}
