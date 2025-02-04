<?php
namespace App\Core;

abstract class Controller {
    protected View $view;
    protected Model $model;
    protected array|bool $item;

    public function requireID(): void {
        if (!isset($_GET['id'])) {
            Router::error404();
        }
    }

    public function requireItem() {
        $this->requireID();
        $this->item = $this->model->get($_GET['id']);
        if (!$this->item) {
            Router::error404();
        }
    }

}
