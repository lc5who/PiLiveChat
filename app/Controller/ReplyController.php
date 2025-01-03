<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Reply;
use App\Request\ReplyRequest;
use App\Resource\ReplyCollection;
use App\Resource\ReplyResource;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Qbhy\HyperfAuth\AuthMiddleware;

#[AutoController]
#[Middlewares([AuthMiddleware::class])]
class ReplyController extends AbstractController
{
    public function index()
    {
        return $this->success("ok",ReplyResource::collection(Reply::all()));
    }

    public function list()
    {
        return $this->success("ok",ReplyResource::collection(Reply::all()));
    }
    public function store(ReplyRequest $replyRequest)
    {
        $validated = $replyRequest->validated();
        $reply = Reply::create($validated);
        return $this->success("ok",new ReplyResource($reply));
    }
    public function show(){
        $reply = Reply::findOrFail($this->request->input('id'));
        return $this->success("ok",new ReplyResource($reply));
    }
    public function update(ReplyRequest $replyRequest){
        $validated = $replyRequest->validated();
        $reply = Reply::findOrFail($this->request->input('id'));
        $reply->update($validated);
        return $this->success("ok",new ReplyResource($reply));
    }
    public function destroy(){
        try {
            $reply = Reply::findOrFail($this->request->input('id'));
            $reply->delete();
        }catch (\Exception $e) {
            return $this->fail();
        }
        return $this->success();
    }
}
