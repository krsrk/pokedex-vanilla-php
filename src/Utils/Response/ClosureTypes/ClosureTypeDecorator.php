<?php

namespace Utils\Response\ClosureTypes;

class ClosureTypeDecorator
{
    protected mixed $closureDecorator;
    protected string $closureNameSpace = __NAMESPACE__ . '\\' . 'Closures';

    public function __construct(protected string $closureName)
    {
        $this->_setClosureDecorator();
    }

    public static function from(string $closureName): self
    {
        return new static($closureName);
    }

    public function getClosure(): mixed
    {
        return $this->closureDecorator;
    }

    private function _setClosureDecorator(): void
    {
        $this->closureDecorator = $this->closureNameSpace  . '\\ClosureType' . ucwords($this->closureName);
    }
}