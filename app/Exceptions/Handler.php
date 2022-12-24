<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;
//
use Throwable;

class Handler extends ExceptionHandler
{
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
    private function getMsg($ex, $a) {
        if(env("APP_DEBUG")) {
            return $ex->getMessage();
        }else {
            return $a;
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
        $this->renderable(function (InvalidArgumentException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "InvalidArgumentException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (DomainException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "DomainException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (SignatureInvalidException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "SignatureInvalidException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (BeforeValidException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "BeforeValidException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (ExpiredException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "ExpiredException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (UnexpectedValueException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => "UnexpectedValueException: ". $this->getMsg($e, trans("messages.auth.failed"))
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (Illuminate\Database\QueryException $e, $request) {
            return response()->json([
               'success' => false,
               'message' => "QueryException: some error occurred"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, $request) {
            return response()->json([
               'success' => false,
               'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
    
}
