<?php

use Utils\View\View;


if (! function_exists('view')) {
    function view(string $viewFile, array $opts = [])
    {
        $template = new View();
        $template->render($viewFile, $opts);
    }
}
