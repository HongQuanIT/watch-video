<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // AuthenticationException::class,
        // AuthorizationException::class,
        // \Symfony\Component\HttpKernel\Exception\HttpException::class,
        // \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        // \Illuminate\Session\TokenMismatchException::class,
        // \Illuminate\Validation\ValidationException::class,
    ];
    // public function report(Exception $exception)
    // {
    //     parent::report($exception->getMessage());
    // }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    // public function register()
    // {
        
    //     $this->reportable(function (NotFoundHttpException $e, $request) {
    //         dd('haha');
    //         return $this->handleException($request, $e);
    //     });
    // }
    // public function handleException($request, $exception)
    // {
    //     // dd($exception);
    //     if($exception instanceof RouteNotFoundException) {
    //        return response('The specified URL cannot be  found.', 404);
    //     }
    //     if($exception instanceof AuthenticationException) {
    //         return response('Tnonono.', 401);
    //     }
    //     if ($exception instanceof NotFoundHttpException) {
    //         return response('sadsad dfasdfs.', 404);
    //     }
    // }
    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $data = [
            'status' => false,
            'code' => 403,
            'message' => $exception->getMessage(),
            'data' => null,
        ];
        return $request->isJson()
                    ? response()->json($data, 403)
                    : redirect()->guest(route('login'));
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    { 
        if ($exception instanceof NotFoundHttpException ) {
            $data = [
                'status' => false,
                'code' => 404,
                'message' => $exception->getMessage(),
            ];
            return response($data, 404);
        }

        if ($exception instanceof RouteNotFoundException) {
            $data = [
                'status' => false,
                'code' => 403,
                'message' => $exception->getMessage(),
            ];
            return response($data, 403);
        }

        if ($exception instanceof AuthenticationException) {
            $data = [
                'status' => false,
                'code' => 401,
                'message' => $exception->getMessage(),
            ];
            return response($data, 401);
        }
        if (! $this->isHttpException($exception)) {
            $data = [
                'status' => false,
                'code' => 500,
                'message' => $exception->getMessage(),
                'errors' => [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTrace()
                ],
            ];
            return response($data, 500);
        }
        

        return parent::render($request, $exception);
    }
}
