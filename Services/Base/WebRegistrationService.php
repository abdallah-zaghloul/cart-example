<?php

namespace Modules\User\Services\Base;

use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as Foundation;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\User;
use Modules\User\Providers\RouteServiceProvider;
use Illuminate\Contracts\Validation\Validator as ValidatorInterface;

/**
 *
 */
trait WebRegistrationService
{
    /*
        |--------------------------------------------------------------------------
        | Register Service
        |--------------------------------------------------------------------------
        |
        | This Service handles the registration of new users as well as their
        | validation and creation. By default the Registration controller uses a trait to
        | provide this functionality without requiring any additional code.
        |
        */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return ValidatorInterface
     */
    protected function validator(array $data): ValidatorInterface
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    /**
     * @return Guard|Application|StatefulGuard|Foundation|Factory
     */
    protected function guard(): Guard|Application|StatefulGuard|Foundation|Factory
    {
        return auth('web');
    }


    /**
     * @return View|Application|ViewFactory|Foundation
     */
    public function showRegistrationForm(): View|Application|ViewFactory|Foundation
    {
        return view('user::register');
    }
}
