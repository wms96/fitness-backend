<?php

namespace App\Http\Middleware;

use App\Member;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Config;

class CustomJWT
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $JWTAuth;
    protected $getUserFromToken;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
        $token = str_replace('Bearer ', '', $token);

        $segments = explode('.', $token);
        if (count($segments) !== 3) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        list($header, $payload, $signature) = $segments;

        $data = json_decode(base64_decode($payload), true);
        $user = Member::find($data['sub']);
        if(!$user){
            return response()->json(['message' => 'Token has expired'], 401);
        }
        // Verify the token here, for example, by checking the expiration date.
        if ($data['exp'] < time()) {
            return response()->json(['message' => 'Token has expired'], 401);
        }

        // Optionally, you can check additional claims or data in the $data variable.
        $request->attributes->add(['member' => $user]);

        return $next($request);

    }
}
