<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

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

        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                $notification = array(
                    'message' => 'Something went wrong',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        });

        $this->renderable(function (InvalidSignatureException $e) {
            if(request()->segment(1) === 'verify-email'){
                $notification = array(
                    'message' => 'Your request is not valid',
                    'alert-type' => 'error'
                );
                return redirect()->route('verification.notice')->with($notification);
            }
        });
    }
}
