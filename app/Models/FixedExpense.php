<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class FixedExpense extends Model
{
    protected $table = "fixed_expenses";
    protected $fillable = [
        'supervisor_id', 'fixed_expense'
    ];

    public function supervisor()
    {
        return $this->belongsTo('\App\Models\Supervisor', 'supervisor_id', 'id');
    }

    public function expenses()
    {
        return $this->hasMany('\App\Models\Expense', 'fixed_id', 'id');
    }
}
