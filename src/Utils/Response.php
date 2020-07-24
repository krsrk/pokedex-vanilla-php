<?php


namespace Utils;


class Response
{
    protected $closure;

    public function __construct($closure)
    {
        $this->setClosure($closure);
    }

    public function send($request)
    {
        if ($this->closure['closure_type'] == 'string') {
            echo $this->closure['closure'];
        } elseif ($this->closure['closure_type'] == 'array') {
            echo json_encode($this->closure['closure']);
        } elseif ($this->closure['closure_type'] == 'closure' || $this->closure['closure_type'] == 'controller') {
            $this->_executeClosure($request);
        } else {
            header("HTTP/1.0 404 Not Found");
            exit('<h3>404 - Not Found</h3>');
        }
    }

    private function _executeClosure($request)
    {
        $closure = $this->closure['closure'];
        $parameters = $request->getParams();
        $isControllerClosure = ($this->closure['closure_type'] == 'controller');

        if ($isControllerClosure) {
           $controller = $this->closure['object_info']['class_instance'];
           $controllerMethod = $this->closure['object_info']['method'];
        }

        return ($isControllerClosure) ? $controller->$controllerMethod() : call_user_func_array($closure, $parameters);
    }

    /**
     * @return mixed
     */
    public function getClosure()
    {
        return $this->closure;
    }

    /**
     * @param mixed $closure
     */
    public function setClosure($closure): void
    {
        $controllerNamespace = '\App\Controllers\\';
        $closureType = 'unknown';
        $objectInfo = [];

        if (is_string($closure)) {
            $closureType = 'string';
            $closureArr = explode('@', $closure);
            if (count($closureArr) > 1) {
                $closureType = 'controller';
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
            $closureType = 'array';
        }

        if (is_callable($closure)) {
            $closureType = 'closure';
        }

        $this->closure = [
            'closure' => $closure,
            'closure_type' => $closureType,
            'object_info' => $objectInfo,
        ];
    }


}