<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Redirect;
use App\Views\MainView;

class MainController extends Controller
{
    public function __construct()
    {
        $this->view = new MainView;
    }

    public function indexAction(): void
    {
        Redirect::redirect('/order');
    }
}
