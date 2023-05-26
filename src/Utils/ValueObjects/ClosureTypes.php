<?php

namespace Utils\ValueObjects;

enum ClosureTypes: string
{
    case CLOSURE_STRING = 'string';

    case CLOSURE_ARRAY = 'array';

    case CLOSURE_CONTROLLER = 'controller';

    case CLOSURE_FUNCTION = 'function';
}
