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

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Swow\Psr7\Message\ResponsePlusInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponsePlusInterface $response)
    {
        $this->stopPropagation();
        /** @var ValidationException $throwable */
        $body = $throwable->validator->errors()->first();
        if (! $response->hasHeader('content-type')) {
            $response = $response->addHeader('content-type', 'text/plain; charset=utf-8');
        }
        $data = json_encode([
            'code'=>$throwable->status,
            'msg'=>$body,
            'data'=>[]
        ],JSON_UNESCAPED_UNICODE);

        return $response->setStatus($throwable->status)->setBody(new SwooleStream($data));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}

