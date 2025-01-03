<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property string $name 
 * @property string $content 
 */
class Reply extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'Reply';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['keyword','content'];



    public bool $timestamps = true;
}
