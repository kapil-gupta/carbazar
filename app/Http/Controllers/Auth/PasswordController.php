<?php

namespace SmartCarBazar\Http\Controllers\Auth;

use SmartCarBazar\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
class PasswordController extends Controller {
    use ResetsPasswords;
    public $redirectPath = '';
    public $redirectAfterLogout='';
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->redirectAfterLogout = '/auth/login';
        $this->redirectPath = admin_route('dashboard');
        $this->middleware('guest');
    }
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        Auth::login($user);
    }
}
