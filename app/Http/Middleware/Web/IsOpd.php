<?php

namespace App\Http\Middleware\Web;

use Closure;

class IsOpd
{
    public function handle($request, Closure $next)
    {
        $auth = auth()->guard('web');
        if ($auth->check() && $auth->user()->role_id == 3) {
            return $next($request);
        }
        return redirect()->back()
            ->with('message', \GeneralHelper::format_message('Hanya bisa diakses oleh OPD !', 'danger'));
    }
}
