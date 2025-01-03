<?php

declare(strict_types=1);

namespace App\Controller;



use App\Request\LoginRequest;
use App\Resource\UserResource;
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
        $result = array_merge((new UserResource($user))->toArray(),['token'=>$token]);
        $cache = $this->container->get(\Psr\SimpleCache\CacheInterface::class);
        $cache->set($token,$result);
        return $this->success($result,'登录成功');
    }

    public function getOnlineCustomers()
    {
        $uid = $this->auth->guard()->id();

    }

    public function getOffCustomers()
    {
        return $this->response->json(['1'=>2]);
    }
    public function test()
    {
        return $this->response->json(['1'=>2]);

    }
}
