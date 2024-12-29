<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Qbhy\HyperfAuth\Authenticatable;

/**
 * @property int $id 
 * @property string $name 
 * @property string $password 
 * @property string $nickname 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @property string $avator 
 */
class User extends Model implements Authenticatable
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'User';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function getId()
    {
        return $this->id;
    }

    public static function retrieveById($key): ?Authenticatable
    {
        return User::find($key);
    }
}
