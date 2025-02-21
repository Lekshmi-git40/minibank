<?php

namespace App\Utils;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $CurrentUser;

    public function __construct()
    {
        $this->CurrentUser = Auth::user();
        View::share('CurrentUser', $this->CurrentUser);
    }

    public function NotFound($error2=null)
    {
        return Redirect::route('error404', compact('error2'));
    }

    public function Unauthorized($error2=null)
    {
        return Redirect::route('error403', compact('error2'));
    }
}
