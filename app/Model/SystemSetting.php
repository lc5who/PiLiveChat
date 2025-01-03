<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $system_name 
 * @property string $system_logo 
 * @property string $welcome_message 
 * @property int $enable_notification 
 * @property int $enable_sound 
 * @property int $visitor_timeout 
 * @property int $history_days 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class SystemSetting extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_settings';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'system_name',
        'system_logo',
        'welcome_message',
        'enable_notification',
        'enable_sound',
        'visitor_timeout',
        'history_days',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'enable_notification' => 'integer', 'enable_sound' => 'integer', 'visitor_timeout' => 'integer', 'history_days' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
