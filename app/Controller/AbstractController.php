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

    public function success($code=1,$msg='success',$data=[])
    {
        return $this->response->json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ])->withStatus(200);
    }

    public function fail($code=0,$msg='fail',$data=[])
    {
        return $this->response->json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ])->withStatus(400);
    }
}
