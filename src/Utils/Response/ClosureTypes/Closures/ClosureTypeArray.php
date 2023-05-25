<?php

namespace Utils\Response\ClosureTypes\Closures;

class ClosureTypeArray
{
    public function __construct(protected array $closureValue){}

    public static function from(array $value): self
    {
        return new static($value);
    }

    public function execute(array $params = null): void
    {
        echo json_encode($this->closureValue);
    }
}