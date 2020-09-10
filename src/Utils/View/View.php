<?php


namespace Utils\View;

use Twig\Loader\FilesystemLoader as Loader;
use Twig\Environment;

class View
{
    const TEMPLATES_PATH = __DIR__ . '/resources/views';
    const CACHE_PATH = __DIR__ . '/resources/views/cache';

    protected $view;

    public function __construct()
    {
        $this->_init();
    }

    private function _init()
    {
        $loader = new Loader(self::TEMPLATES_PATH);
        $this->view = new Environment($loader, [
            'cache' => self::CACHE_PATH,
        ]);
    }

    public function render(string $viewFile, array $opts = []) : Environment
    {
        echo $this->view->render($viewFile, $opts);
    }
}