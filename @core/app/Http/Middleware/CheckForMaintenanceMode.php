<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Permission\GeneralSettings;
use App\StaticOption;
use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [

    ];

    public function handle($request, Closure $next, $guard = null){
       $mode=StaticOption::where('option_name','site_maintenance_mode')->first();
        if ( $mode->option_value == 'on' && !$request->is('admin-home/*')){
            return response()->view('frontend.maintain', [], 503);
        }

        return $next($request);
    }


}
