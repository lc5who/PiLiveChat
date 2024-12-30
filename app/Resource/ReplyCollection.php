<?php

namespace App\Resource;

use Hyperf\Resource\Json\ResourceCollection;

class ReplyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'list' => $this->collection,
        ];
    }
}
