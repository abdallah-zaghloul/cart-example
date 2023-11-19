<?php

namespace Modules\User\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as VendorEnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

/**
 *
 */
class EnsureEmailIsVerified extends VendorEnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $redirectToRoute
     * @return Response|RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null): Response|RedirectResponse|null
    {
        return match ($this->shouldVerifyEmail($request)){
            true => $this->redirectAccTo($request, $redirectToRoute),
            default => $next($request)
        };
    }


    /**
     * @param $request
     * @param $redirectToRoute
     * @return RedirectResponse
     */
    protected function redirectAccTo($request, $redirectToRoute = null): RedirectResponse
    {
        return $request->expectsJson()
            ? abort(403, 'Your email address is not verified.')
            : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
    }


    /**
     * @param $request
     * @return bool
     */
    protected function shouldVerifyEmail($request): bool
    {
        return ! ($user = $request->user()) or collect([
                config('user.should_verify_email'),
                $user instanceof MustVerifyEmail,
                ! $user->hasVerifiedEmail()
        ])->every(fn($condition) => $condition === true);
    }
}
