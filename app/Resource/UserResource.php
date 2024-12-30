<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'=>$this->username,
            'nickname'=>$this->nickname,
            'avator'=>$this->avator,
        ];
    }
}
