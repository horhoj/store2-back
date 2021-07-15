<?php

namespace App\repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthRepository
 *
 * @package App\repositories
 */
class AuthRepository
{
    /**
     * @var Carbon
     */
    private Carbon $carbon;
    /**
     * @var Auth
     */
    private Auth $auth;

    /**
     * AuthRepository constructor.
     *
     * @param Carbon $carbon
     * @param Auth $auth
     */
    public function __construct(Carbon $carbon, Auth $auth)
    {
        $this->carbon = $carbon;
        $this->auth = $auth;
    }

    /**
     * @param array $credentials
     *
     * @return JsonResponse
     */
    public function getAccessToken(array $credentials): JsonResponse
    {
        if (!$this->auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = $this->auth::user()->createToken(config('app.name'));
        $token->token->expires_at = $this->carbon::now()->addMonths(1);

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => $this->carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function revokeToken(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'logout']);
    }

    /**
     * @param array $credentials
     *
     * @return JsonResponse
     */
    public function register(array $credentials): JsonResponse
    {
        $data = User::create($credentials);

        return response()->json($data, Response::HTTP_CREATED);
    }
}
