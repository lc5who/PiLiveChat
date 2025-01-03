<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\SystemSetting;
use App\Resource\SystemSettingResource;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middlewares;
use Qbhy\HyperfAuth\AuthMiddleware;
use function Symfony\Component\Translation\t;

/**
 * @AutoController(prefix="system-settings")
 */
#[AutoController(prefix: 'settings')]
#[Middlewares([AuthMiddleware::class])]
class SystemSettingController extends AbstractController
{
    /**
     * 获取系统设置
     */
    public function index()
    {
        $systemSetting = SystemSetting::find(1);
        return $this->success('获取成功',new SystemSettingResource($systemSetting));
    }

    /**
     * 更新系统设置
     */
    public function update()
    {
        $data = $this->request->all();
        $systemSetting = SystemSetting::firstOrNew(['id' => 1]);
        $systemSetting->fill($data);
        $systemSetting->save();
        return $this->success('更新成功',new SystemSettingResource($systemSetting));
    }

    public function upload_logo()
    {
        $file = $this->request->file('file');
        var_dump($file);
        if (!$file) {
            return $this->fail('参数错误');
        }
        try {
            $path = $file->getRealPath();
            $ext = $file->getExtension();
//            $ext = pathinfo($file->getFileInfo("name"), PATHINFO_EXTENSION);
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