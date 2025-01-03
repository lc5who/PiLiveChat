<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    protected function success($msg='success',$data=[],$code=1)
    {
        return $this->response->json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ])->withStatus(200);
    }

    protected function fail($msg='fail',$data=[],$code=0)
    {
        return $this->response->json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ])->withStatus(400);
    }
}
