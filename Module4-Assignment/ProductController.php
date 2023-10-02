<?php
class ProductController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function showProductDetails() {
        $this->view->showDetails($this->model);
    }
}
