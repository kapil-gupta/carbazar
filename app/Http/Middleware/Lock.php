<?php

namespace SmartCarBazar\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Lock {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            if ($request->session()->has('locked')) {
                return redirect('auth/lock');
            } else {
                $now = strtotime("now");
                $last_activity = strtotime($this->auth->user()->last_activity);
                $diff = ( ($now - $last_activity) / 60 );
                $timeout = "1000";
                if ($diff > $timeout && !$request->ajax()) {
                    session(['locked' => 1]);
                    $_SESSION['_sf2_attributes.url.intended'] = $request->fullUrl();
                    return redirect('auth/lock');
                }
                // TImeout has not occurred, update last_activity
                $this->auth->user()->last_activity = date("Y-m-d H:i:s", strtotime("now"));
                $this->auth->user()->save();
            }
        }
        return $next($request);
    }

}
