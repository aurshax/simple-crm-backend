<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 *
 */
class Handler extends ExceptionHandler
{
    /**
     * @var array
     */
    protected $dontReport = [];

    /**
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }


    /**
     * @param $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        // Agar API so‘rovi bo‘lsa (Postman, frontend, va h.k.)
        if ($request->is('api/*') || $request->expectsJson()) {
            $status = 500;
            $message = $e->getMessage();

            // Agar bu HttpException bo‘lsa (masalan 404 yoki 403)
            if ($e instanceof HttpExceptionInterface) {
                $status = $e->getStatusCode();
            }

            return response()->json([
                'message' => 'Xatolik yuz berdi',
                'error' => $message,
            ], $status);
        }

        // Aks holda default holatda render qil (web sahifa uchun)
        return parent::render($request, $e);
    }
}
