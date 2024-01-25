<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\NotFoundExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
    public function register()
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->handleApiExceptions($e, $request);
            }

            return $this->handleWebExceptions($e, $request);
        });
    }
    private function handleApiExceptions(Throwable $e, Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id ?? 1;
        $code = $e->getCode();
        if ($e instanceof AuthenticationException) {
            return $this->jsonResponse(-32600, 'Unauthenticated', 401,false);
        }elseif ($e instanceof NotFoundHttpException) {
            $code = -32600;
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $code = -32601;
        } elseif ($e instanceof NotFoundExceptionInterface) {
            $code = -32700;
        }
        return $this->jsonResponse($code??500, $e->getMessage() . ". Line:" . $e->getLine() . ". File:" . pathinfo($e->getFile())['basename']);
    }

    private function handleWebExceptions(Throwable $e, Request $request): Response
    {
        if ($e instanceof NotFoundHttpException) {
            return redirect('/');
        }

        if (auth()->guest()) {
            return redirect()->route('login');
        }

        return parent::render($request, $e);
    }

    private function jsonResponse(int $code, string $message, int $statusCode = 200,bool $auth=true): \Illuminate\Http\JsonResponse
    {
        $data = [
            'jsonrpc'   => '2.0',
            'status'    => false,
            'origin'    => 'any.error',
            'error'     => [
                'code'      => $code,
                'message'   => $message,
            ],
            'host'      => [
                'name'      => config('app.name'),
                'time_stamp'=> now()->toDateTimeString(),
            ],
        ];
        if (!$auth)
            $data['error']['auth'] = false;
        return response()->json($data, $statusCode);
    }
}
