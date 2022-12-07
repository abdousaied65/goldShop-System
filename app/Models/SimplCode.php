<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static First()
 */
class SimplCode extends Model
{
    protected $table = "simplcode";
    protected $fillable = [
        'SimplCode'
    ];
}
