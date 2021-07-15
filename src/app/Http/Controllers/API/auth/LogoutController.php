<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\repositories\AuthRepository;
use Illuminate\Http\Request;

/**
 * Class LogoutController
 *
 * @package App\Http\Controllers\API\auth
 */
class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param AuthRepository $authRepository
     *
     * @return string
     */
    public function __invoke(Request $request, AuthRepository $authRepository): string
    {
        return $authRepository->revokeToken($request);
    }
}
