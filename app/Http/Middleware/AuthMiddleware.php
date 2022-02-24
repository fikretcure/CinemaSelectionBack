<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class AuthMiddleware extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        switch ($request->route()->getName()) {
            case 'auth.login':
                return $next($request);
                break;
            default:
                try {
                    $decoded = JWT::decode($request->header('x-access-token'), env('JWT_SECRET'), array('HS256'));
                    $request->request->add(['user_id' => $decoded->id]);
                    return $next($request);
                } catch (\Throwable $th) {
                    try {
                        $decoded = JWT::decode($request->header('x-refresh-token'), env('JWT_SECRET'), array('HS256'));
                        $request->request->add(['user_id' => $decoded->id]);
                        return $next($request);
                    } catch (\Throwable $th) {
                        return $this->catch("hata refresh");
                    }
                    return $this->catch("hata access");
                }
                break;
        }
    }
}
