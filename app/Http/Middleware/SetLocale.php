<?php

namespace App\Http\Middleware;

use App\Helpers\CheckLangHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{

    /**
     * Find locale field in request and try change lang to locale field
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('locale') && CheckLangHelper::checkIfLangAvailable($request->get('locale')))
            App::setLocale($request->get('locale'));;
        return $next($request);
    }
}
