<?php

declare(strict_types=1);

namespace App\Controller;


use App\Model\User;
use App\Request\LoginRequest;
use App\Service\UserService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Di\Annotation\Inject;
use Qbhy\HyperfAuth\AuthManager;

class UserController extends AbstractController
{
    #[Inject]
    protected AuthManager $auth;
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $loginRequest, ResponseInterface $response)
    {
        $validata = $loginRequest->validated();
        $user = $this->userService->login($validata);
        $token =$this->auth->guard()->login($user);
        return $response->json($token);
    }

    public function test()
    {
        return $this->response->json(['1'=>2]);
    }
}
