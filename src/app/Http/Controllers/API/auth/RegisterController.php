<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterRequest;
use App\repositories\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\API\auth
 */
class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $registerRequest
     * @param AuthRepository $authRepository
     *
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $registerRequest, AuthRepository $authRepository): JsonResponse
    {
        $credentials = [
            'name' => $registerRequest->name,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password),
        ];

        return $authRepository->register($credentials);
    }
}
