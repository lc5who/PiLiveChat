<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Engine\WebSocket\Frame;
use Hyperf\Engine\WebSocket\Response;
use Swoole\Server;
use Swoole\WebSocket\Server as WebSocketServer;

class CustomerSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    protected $redis;
    public function __construct()
    {
        $this->redis = ApplicationContext::getContainer()->get(\Redis::class);
    }
    public function onMessage($server, $frame): void
    {
        $response = (new Response($server))->init($frame);
        if ($frame->data=='ping'){
            $response->push(new Frame(payloadData: 'pong'));
            return;
        }
        $msg = json_decode($frame->data,true);
        if (!isset($msg['type']) || !isset($msg['data'])){
            $response->push(new Frame(payloadData: 'wrong msg'));
            return;
        }
        switch ($msg['type']){
            //客服上线
            case 'online':
                //获取客服下面的用户列表
                $response->push(new Frame(payloadData: 'Recv: ' . $frame->data));
                break;
            //客服发送消息
            case 'message':
                $response->push(new Frame(payloadData: 'Recv: ' . $frame->data));
                break;
            //客服下线
            case 'offline':
                $response->push(new Frame(payloadData: 'Recv: ' . $frame->data));
                break;
            default:
                $response->push(new Frame(payloadData: 'Recv: ' . $frame->data));
                break;
        }
        $response->push(new Frame(payloadData: 'Recv: ' . $frame->data));
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen($server, $request): void
    {
        $response = (new Response($server))->init($request);
        $fd =$request->fd;
        if (!isset($request->get['cid']) || !isset($request->get['oid'])){
            $response->push(new Frame(payloadData: '0'));
            return;
        }
        $oid = $request->get['oid'];
        $cid = $request->get['cid'];
        $this->redis->hSet('customer:'.$cid,'fd',$fd);
        $this->redis->hSet('customer:'.$cid,'oid',$oid);
        //获取客服的fd
        $ofd = $this->redis->hGet('operator:'.$oid,'fd');
        $this->redis->hSet('customer:'.$cid,'ofd',$ofd);
        $response->push(new Frame(payloadData: $fd));
    }


}