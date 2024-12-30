<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'name'=>$this->name,
            'content'=>$this->content,
        ];
    }
}
