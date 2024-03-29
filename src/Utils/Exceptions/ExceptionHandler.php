<?php


namespace Utils\Exceptions;


class ExceptionHandler implements Exception
{

    public function handle(): void
    {
        set_exception_handler(function ($exception) {
            $this->_initException($exception);
        });
    }

    private function _initException($exception): void
    {
        view('errors/500-internal-error.html', [
            'debug' => env_var('APP_DEBUG'),
            'exceptionMessage' => $exception->getMessage(),
            'exceptionFile' => $exception->getFile(),
            'exceptionLine' => $exception->getLine(),
        ]);
    }
}
