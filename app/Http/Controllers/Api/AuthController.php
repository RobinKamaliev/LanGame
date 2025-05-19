<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ConfirmCodeRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\User\CreateUserResource;
use App\Http\Resources\User\LoginUserResource;
use App\Modules\User\Services\Auth\ConfirmCodeService;
use App\Modules\User\Services\Auth\CreateUserService;
use App\Modules\User\Services\Auth\LoginUserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthController extends Controller
{
    public function register(StoreUserRequest $storeUserRequest, CreateUserService $createUserService): JsonResponse
    {
        return response()->json(
            CreateUserResource::make(
                $createUserService->run(
                    $storeUserRequest->toDto()
                )
            ),
            Response::HTTP_CREATED
        );
    }

    public function login(LoginUserRequest $loginUserRequest, LoginUserService $loginUserService): JsonResponse
    {
        return response()->json(
            LoginUserResource::make(
                $loginUserService->run(
                    $loginUserRequest->toDto()
                )
            )
        );
    }

    public function confirmCode(ConfirmCodeRequest $confirmCodeRequest, ConfirmCodeService $codeService): JsonResponse
    {
        $codeService->run($confirmCodeRequest->toDto());

        return response()->json(['success' => true]);
    }
}
