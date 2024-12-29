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

use App\Exception\ApiException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Swow\Psr7\Message\ResponsePlusInterface;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponsePlusInterface $response)
    {

        if ($throwable instanceof ApiException) {
            $this->stopPropagation();
            if (!$response->hasHeader('content-type')) {
                $response = $response->addHeader('content-type', 'text/plain; charset=utf-8');
            }
            $data = json_encode([
                'code' => $throwable->getCode(),
                'msg' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            return $response->setStatus(400)->setBody(new SwooleStream($data));
        }
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}

