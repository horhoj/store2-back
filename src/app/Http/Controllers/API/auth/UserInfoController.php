<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class UserInfoController
 *
 * @package App\Http\Controllers\API\auth
 */
class UserInfoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request): mixed
    {
        return $request->user();
    }
}
