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

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function test()
    {
        return ['code'=>1];
    }

    public function upload()
    {
        $file = $this->request->file('file');
        if (!$file) {
            return $this->fail('参数错误');
        }
        try {
            $path = $file->getRealPath();
            $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
            $filename = date('YmdHis') . rand(1000, 9999) . '.' . $ext;
            $savePath = BASE_PATH . '/public/uploads/' . $filename;
            if (!file_exists(BASE_PATH . '/public/uploads')) {
                mkdir(BASE_PATH . '/public/uploads', 0777, true);
            }
            if (move_uploaded_file($path, $savePath)) {
                return $this->success('上传成功', ['url' => '/uploads/' . $filename]);
            }
            return $this->fail('上传失败');
        }
        catch (\Exception $e) {
            return $this->fail('上传失败');
        }
    }
}
