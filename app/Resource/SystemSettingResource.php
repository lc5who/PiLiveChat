<?php

declare(strict_types=1);

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class SystemSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'system_name' => $this->system_name,
            'system_logo' => $this->system_logo,
            'welcome_message' => $this->welcome_message,
            'enable_notification' => (bool) $this->enable_notification,
            'enable_sound' => (bool) $this->enable_sound,
            'visitor_timeout' => $this->visitor_timeout,
            'history_days' => $this->history_days,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}