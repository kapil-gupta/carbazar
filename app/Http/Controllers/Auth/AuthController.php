<?php

namespace SmartCarBazar\Http\Controllers\Auth;

use SmartCarBazar\Models\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use SmartCarBazar\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use SmartCarBazar\Http\Controllers\CorporateController as CorporateController;

class AuthController extends CorporateController {

    public $redirectPath = '';
    public $redirectAfterLogout = '';

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

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->redirectAfterLogout = '/auth/login';
        $this->redirectPath = admin_route('dashboard');
        $this->middleware('guest', ['except' => ['getLogout', 'lock']]);
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function lock(Request $request) {

        if (Auth::user()) {
            // setting the page related information
            $this->page->getHead()->setDescription('Lock page');
            $this->page->getHead()->setKeywords('lock, inactive, relogin');
            $this->page->getHead()->setTitle('Lock Screen');

            if (!empty($_POST)) {
                $this->validate($request, [
                    'password' => 'required|min:6',
                ]);
                $user = new User();
                $mr = $user->login(Auth::user()->email, $request->get('password'));
                if ($mr) {
                    $request->session()->forget('locked');
                    Auth::loginUsingId($mr->id);
                    return redirect()->intended('/admin/dashboard');
                } else
                    return redirect('auth/lock')->withInput()->withErrors(['error' => 'You are not authorised to view this page']);
            }

            if (!$request->session()->has('locked')) {
                $request->session()->put('locked', 1);
            }

            //$viewPath = $this->viewBase . '.lock';
            return view('auth.lock');
        } else {
            return redirect()->intended('/admin/dashboard');
        }
    }

}
