<?php

namespace Utils\Response\ClosureTypes;


class ClosureType
{
    protected mixed $closureDecorator;

    public function __construct(protected string $closureName, protected mixed $closureValue)
    {
        $this->_setClosureDecorator();
    }

    public static function from(string $closureName, mixed $closureValue): self
    {
        return new static($closureName, $closureValue);
    }

    public function execute(mixed $params = null): void
    {
        $this->closureDecorator::from($this->closureValue)->execute($params);
    }

    private function _setClosureDecorator(): void
    {
        $this->closureDecorator = ClosureTypeDecorator::from($this->closureName)->getClosure();
    }
}