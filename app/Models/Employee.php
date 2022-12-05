<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = [
        'branch_id','name'
    ];

    public function branch(){
        return $this->belongsTo('\App\Models\Branch','branch_id','id');
    }


}
