<?php

namespace Modules\User\Services\Base;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application as Foundation;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 *
 */
trait WebForgotPasswordService
{
    /*
      |--------------------------------------------------------------------------
      | Forgot Password Service
      |--------------------------------------------------------------------------
      |
      | This service is responsible for handling password reset emails and
      | includes a trait which assists in sending these notifications from
      | your application to your users. Feel free to explore this trait.
      |
      */

    use SendsPasswordResetEmails;


    /**
     * @return View|Application|Factory|Foundation
     */
    public function showLinkRequestForm(): View|Application|Factory|Foundation
    {
        return view('user::password-email');
    }
}
