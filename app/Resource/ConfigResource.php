<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->id,
            'conf_name'=>$this->conf_name,
            'conf_key'=>$this->conf_key,
            'conf_value'=>$this->conf_value,
        ];
    }
}
