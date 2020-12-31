<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        if ($exception instanceof NotFoundHttpException) {
//            if ($request->segment(1) == 'api')
//                return response_api(false, 404, []);
//            return redirect()->to('404');
//        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof OAuthServerException) {
            return response_api(false, 422, null, []);
        }

//        if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
//            if ($request->segment(1) == 'api' || $request->ajax())
//                return response_api(false, 401, 'You don\'t have permissions', []);
//            return redirect('403');
//        }
//        if ($exception instanceof HttpException) {
//            if ($request->segment(1) == 'api' || $request->ajax())
//                return response_api(false, 401, 'You don\'t have permissions', []);
//            return redirect('403');
//        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response_api(false, 401, trans('app.unauthorized'), []);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
