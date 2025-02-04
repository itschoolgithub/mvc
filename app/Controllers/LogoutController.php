<?php
namespace App\Controllers;

use App\Core\Authorization;
use App\Core\Controller;
use App\Core\Redirect;

class LogoutController extends Controller
{
    public function indexAction(): void
    {
        Authorization::logout();
        Redirect::redirect('/login');
    }
}
