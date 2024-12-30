<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Config;
use App\Resource\ConfigCollection;
use Hyperf\HttpServer\Annotation\AutoController;


#[AutoController]
class ConfigController extends  AbstractController
{
    public function index()
    {
        return $this->success((new ConfigCollection(Config::all())));
    }

    public function update()
    {
        $id = $this->request->input('id');
        $conf_value = $this->request->input('value');
        if (!$id || !$conf_value) {
            return $this->fail('参数错误');
        }
        try {
            $config = Config::find($id);
            $config->conf_value = $conf_value;
            $config->save();
            return $this->success('修改成功');
        } catch (\Exception $e) {
            return $this->fail('修改失败');
        }
    }
}
