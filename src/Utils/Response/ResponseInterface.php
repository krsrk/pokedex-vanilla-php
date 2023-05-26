<?php

namespace Utils\Response;

use Utils\Request;

interface ResponseInterface
{
    public function setClosure(): void;

    public function send(Request $request): void;

    public function getClosure(): mixed;

    public function json(mixed $dataResponse, int $codeResponse = 200): void;
}