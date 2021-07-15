<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\repositories\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\API\auth
 */
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param AuthRepository $authRepository
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, AuthRepository $authRepository): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        return $authRepository->getAccessToken($credentials);
    }
}
