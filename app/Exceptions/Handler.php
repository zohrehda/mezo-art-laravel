<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponseBuilderTrait;
use Error;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
 
 
use Exception;


class Handler extends ExceptionHandler
{
    use ApiResponseBuilderTrait ;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        

        $this->renderable(function (ValidationException $e) {
            return $this->response(get_nested_array_values($e->validator->errors()->messages()), [], 422);
        });
        
        $this->renderable(function (AuthenticationException $e) {
            return $this->response($e->getMessage(), [], 401);
        });
        
        $this->renderable(function (Throwable $e) {
         
            $status_code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            return $this->response($e->getMessage(), [], $status_code);
        });
    
    }
}
