<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof NotActivatedException) {
            flash()->error(trans('lucy.auth.not-activated-msg'));

            return redirect_action('Auth\AuthController@getLogin');
        }

        if ($e instanceof ThrottlingException) {
            flash()->error(trans('lucy.auth.throttling-msg'));

            return redirect_action('Auth\AuthController@getLogin');
        }

        return parent::render($request, $e);
    }
}
