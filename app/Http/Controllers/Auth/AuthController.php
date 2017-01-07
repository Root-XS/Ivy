<?php

namespace Ivy\Http\Controllers\Auth;

use Ivy\Model\User;
use Validator;
use Ivy\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'register']]);
    }

    /**
     * Handle a registration request for the application.
     *
     * Overrides parent::register().
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $oUser = $this->create($request->all());

        if (Auth::user() && Auth::user()->hasAbility('create-users')) {
            $strRedirect = '/people/edit/' . $oUser->id;
        } else {
            Auth::guard($this->getGuard())->login($oUser);
            $strRedirect = $this->redirectPath();
        }

        return redirect($strRedirect);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $aData
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $aData)
    {
        return Validator::make($aData, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            // Password not required when an Admin is adding people.
            'password' => (Auth::user() && Auth::user()->hasAbility('create-users') ? '' : 'required|')
                . 'min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $aData
     * @return User
     */
    protected function create(array $aData)
    {
        if (isset($aData['password']))
            $aData['password'] = bcrypt($aData['password']);
        return User::create($aData);
    }
}
