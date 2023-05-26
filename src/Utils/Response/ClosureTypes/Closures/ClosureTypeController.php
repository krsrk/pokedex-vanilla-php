<?php

namespace Utils\Response\ClosureTypes\Closures;

use Utils\Request;
use Utils\ValueObjects\ClosureTypes;

class ClosureTypeController
{
    public function __construct(protected mixed $closureValue){}

    public static function from(mixed $value): self
    {
        return new static($value);
    }

    public function execute(array $params = null): mixed
    {
        $controller = $this->closureValue['class_instance'];
        $controllerMethod = $this->closureValue['method'];

        return $controller->$controllerMethod($params);
    }
}