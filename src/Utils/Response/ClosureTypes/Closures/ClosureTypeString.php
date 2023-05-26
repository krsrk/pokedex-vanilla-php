<?php

namespace Utils\Response\ClosureTypes\Closures;

class ClosureTypeString
{
    public function __construct(protected string $closureValue){}

    public static function from(string $value): self
    {
        return new static($value);
    }

    public function execute(array $params = null): void
    {
        echo $this->closureValue;
    }
}