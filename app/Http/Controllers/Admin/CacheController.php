<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class CacheController extends Controller
{
    public function clear(): RedirectResponse
    {
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');

      Session::flash('success', 'Cache, route, view, config cleared successfully!');
      return back();
    }
}
