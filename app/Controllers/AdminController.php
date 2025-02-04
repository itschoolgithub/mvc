<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Redirect;

class AdminController extends Controller
{
    public function indexAction(): void
    {
        Redirect::redirectIfNotAuth('/login');
        Redirect::redirect('/admin/order');
    }
}
