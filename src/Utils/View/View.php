<?php


namespace Utils\View;

use Twig\Loader\FilesystemLoader as Loader;
use Twig\Environment;
use Twig\Error\LoaderError;

class View
{
    const TEMPLATES_PATH = 'resources/views';
    const CACHE_PATH = 'resources/views/cache';

    protected $view;

    public function __construct()
    {
        $this->_init();
    }

    private function _init()
    {
        $loader = new Loader(self::TEMPLATES_PATH);
        $this->view = new Environment($loader);
    }

    public function render(string $viewFile, array $opts = [])
    {
        try {
            echo $this->view->render($viewFile, $opts);
        } catch (LoaderError $e) {
            echo $this->view->render('errors/404-not-found.html');
        }
    }
}