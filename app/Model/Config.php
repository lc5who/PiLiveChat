<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $conf_name 
 * @property string $conf_key 
 * @property string $conf_value 
 */
class Config extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'Config';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer','conf_value' => 'string'];
}
