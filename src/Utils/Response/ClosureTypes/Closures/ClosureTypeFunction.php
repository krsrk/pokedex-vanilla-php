<?php

namespace Utils\Response\ClosureTypes\Closures;

use Utils\Request;
use Utils\ValueObjects\ClosureTypes;

class ClosureTypeFunction
{
    public function __construct(protected mixed $closureValue){}

    public static function from(mixed $value): self
    {
        return new static($value);
    }

    public function execute(array $params = null): mixed
    {
        $params = (!is_null($params)) ? $params : [];
        return call_user_func_array($this->closureValue, $params);
    }
}