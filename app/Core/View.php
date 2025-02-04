<?php
namespace App\Core;

abstract class View
{
    protected string $folder;

    public function html(string $template = 'index', array $data = []): void
    {
        $is_auth     = Authorization::isAuth();
        $is_admin    = Authorization::isAdmin();
        $contentFile = 'app/layouts/' . $this->folder . '/' . $template . '.tpl.php';
        include 'app/layouts/layout.tpl.php';
        unset($_SESSION['success'], $_SESSION['danger'], $_SESSION['warning'], $_SESSION['info']);
        die();
    }
}
