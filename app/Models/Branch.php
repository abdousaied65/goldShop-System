<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class Branch extends Model
{
    protected $table = "branches";

    protected $fillable = [
        'branch_name','branch_phone','branch_address','commercial_record','license_number','snap'
    ];

    public function supervisors(){
        return $this->hasMany('\App\Models\Supervisor','branch_id','id');
    }
    public function employees(){
        return $this->hasMany('\App\Models\Employee','branch_id','id');
    }
    public function expenses(){
        return $this->hasMany('\App\Models\Expense','branch_id','id');
    }

}
