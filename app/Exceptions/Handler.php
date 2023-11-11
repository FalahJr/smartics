<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {

      if ($exception instanceof AuthenticationException) {
          return redirect('/');
      } else {
        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {

                // not authorized
                case '403':
                    return \Response::view('errors.403',array(),403);
                    break;

                // not found
                case '404':
                    return \Response::view('errors.404',array(),404);
                    break;

                // internal error
                case '500':
                    return \Response::view('errors.500',array(),500);
                    break;

                default:
                    return $this->renderHttpException($exception);
                    break;
            }
        } else {
          return parent::render($request, $exception);
        }
      }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('admin'));
    }
}