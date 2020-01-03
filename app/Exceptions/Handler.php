<?php

namespace App\Exceptions;

use App\Rules\PhoneNumber;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof PostTooLargeException) {

            /**
             * - - - - - - - - - - - - - PLEASE NOTE - - - - - - - - - - - - - -
             * Remember to change the following configuration parameters in the php.ini file:
             *
             * - post_max_size
             * - upload_max_filesize
             * - memory_limit
             *
             */
            preg_match('/[A-Za-z]+$/', get_class($exception), $exceptionClass);
            $errors = new MessageBag();

            $errors->add($exceptionClass[0], __('exceptions.' . $exceptionClass[0]));

            return redirect($request->getRequestUri())
                ->withErrors($errors);
        }

        return parent::render($request, $exception);
    }
}
