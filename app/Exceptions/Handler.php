<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Exception $exception, $request) {
            if ($request->is('api/*')) {
                switch ($exception) {
                    case config('app.debug'):
                        break;
                    case $exception instanceof NotFoundHttpException:
                        return $this->errorResponse(__('response.not_found'), Response::HTTP_NOT_FOUND);
                        break;
                    case $exception instanceof MethodNotAllowedHttpException:
                        return $this->errorResponse(__('response.method_not_allowed'), Response::HTTP_METHOD_NOT_ALLOWED);
                        break;
                    case $exception instanceof HttpException:
                        return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
                        break;
                    case $exception instanceof ValidationException:
                        return $this->errorResponse($exception->validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
                        break;
                    case $exception instanceof AuthenticationException:
                        return $this->errorResponse(__('response.unauthorized'), Response::HTTP_UNAUTHORIZED);
                        break;
                    default:
                        return $this->errorResponse(__('response.internal_server_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        });
    }
}
