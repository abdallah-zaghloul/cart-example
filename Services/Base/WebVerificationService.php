<?php

namespace Modules\User\Services\Base;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as Foundation;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Modules\User\Providers\RouteServiceProvider;

/**
 *
 */
trait WebVerificationService
{
    /*
   |--------------------------------------------------------------------------
   | Email Verification Service
   |--------------------------------------------------------------------------
   |
   | This service is responsible for handling email verification for any
   | user that recently registered with the application. Emails may also
   | be re-sent if the user didn't receive the original email message.
   |
   */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * @param Request $request
     * @return Application|View|Factory|Redirector|Foundation|RedirectResponse
     */
    public function show(Request $request): Application|View|Factory|Redirector|Foundation|RedirectResponse
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('user::verify');
    }


    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function resend(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : back()->with('resent', true);
    }
}
