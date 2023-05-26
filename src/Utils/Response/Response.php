<?php


namespace Utils\Response;


use Utils\Request;
use Utils\Response\ClosureTypes\ClosureType;
use Utils\ValueObjects\ClosureTypes;

class Response implements ResponseInterface
{
    public function __construct(protected $closure = null)
    {
        if(!is_null($this->closure)) {
            $this->setClosure();
        }
    }

    public function send(Request $request): void
    {
        if (is_null(ClosureTypes::tryFrom($this->closure['closure_type']))) {
            header("HTTP/1.0 404 Not Found");
            exit('<h3>404 - Not Found</h3>');
        }

        ClosureType::from($this->closure['closure_type'], $this->closure['closure'])->execute($request->getParams());
    }

    /**
     * @param Request $request
     * @return mixed
     * @deprecated
     */
    private function _executeClosure(Request $request)
    {
        $closure = $this->closure['closure'];
        $parameters = $request->getParams();
        $isControllerClosure = ($this->closure['closure_type'] == ClosureTypes::CLOSURE_CONTROLLER->value);

        if ($isControllerClosure) {
           $controller = $this->closure['object_info']['class_instance'];
           $controllerMethod = $this->closure['object_info']['method'];
        }

        return ($isControllerClosure) ? $controller->$controllerMethod($parameters) : call_user_func_array($closure, $parameters);
    }

    public function getClosure(): mixed
    {
        return $this->closure;
    }

    public function setClosure(): void
    {
        $closure = $this->closure;
        $controllerNamespace = '\App\Controllers\\';
        $closureType = 'unknown';
        $objectInfo = [];

        if (is_string($closure)) {
            $closureType = ClosureTypes::CLOSURE_STRING->value;
            $closureArr = explode('@', $closure);
            if (count($closureArr) > 1) {
                $closureType = ClosureTypes::CLOSURE_CONTROLLER->value;
                $closureArr[0] = $controllerNamespace . $closureArr[0];
                $controllerClass = new $closureArr[0];
                $contollerMethod = $closureArr[1];

                $objectInfo = [
                    'class_instance' => $controllerClass,
                    'method' => $contollerMethod,
                ];
            }
        }

        if (is_array($closure)) {
            $closureType = ClosureTypes::CLOSURE_ARRAY->value;
        }

        if (is_callable($closure)) {
            $closureType = ClosureTypes::CLOSURE_FUNCTION->value;
        }

        $this->closure = [
            'closure' => ($closureType != ClosureTypes::CLOSURE_CONTROLLER->value) ? $closure : $objectInfo,
            'closure_type' => $closureType,
            'object_info' => $objectInfo,
        ];
    }

    public function json(mixed $dataResponse, int $codeResponse = 200): void
    {
        $processData = $dataResponse;

        if (is_object($dataResponse)) {
            $processData = $dataResponse->toArray();
        }

        header("Content-Type: application/json", true, $codeResponse);
        echo json_encode($processData);
    }
}
