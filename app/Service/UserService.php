<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\ApiException;
use App\Model\User;

class UserService
{


    public function login($loginData)
    {
        $username = $loginData['username'];
        $password = $loginData['password'];
        $user = User::where('username',$username)->first();
        if (!$user) throw new ApiException('无此用户',-1);
        if ($user['password']!=md5($password)) throw new ApiException('密码错误',-1);
        return $user;
    }
}