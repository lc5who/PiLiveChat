<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\WebSocketServer\Sender;

#[AutoController]
class MessageController extends AbstractController
{

    #[inject]
    protected Sender $sender;
    protected $redis;
    public function __construct()
    {
        $this->redis = ApplicationContext::getContainer()->get(\Redis::class);
    }

    public function sendMessageFromCustomer()
    {
        $oid = (int)$this->request->input('oid');
        $cid = (int)$this->request->input('cid');
        $msg = $this->request->input('msg');
        $ofd = (int)$this->redis->hGet('operator:'.$oid,'fd');
        if (!$oid || !$cid || !$msg){
            return $this->fail('参数错误');
        }
        if ($ofd<1){
            //客户发送离线消息
            return $this->success('客服不在线');
        }
        $this->sender->push($ofd, $msg);
        return $this->success($oid);
    }

    public function close(int $fd)
    {
        go(function () use ($fd) {
            sleep(1);
            $this->sender->disconnect($fd);
        });
        return '';
    }

    public function send(int $fd)
    {
        $this->sender->push($fd, 'Hello World.');

        return '';
    }
}
