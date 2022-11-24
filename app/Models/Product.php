<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
        'product_name','tax'
    ];

}
