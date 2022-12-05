<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class Expense extends Model
{
    protected $table = "expenses";
    protected $fillable = [
        'branch_id', 'supervisor_id', 'fixed_id', 'unified_serial_number', 'date', 'expense_details',
        'amount','expense_pic','notes'
    ];

    public function fixed()
    {
        return $this->belongsTo('\App\Models\FixedExpense', 'fixed_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo('\App\Models\Branch', 'branch_id', 'id');
    }

    public function supervisor()
    {
        return $this->belongsTo('\App\Models\Supervisor', 'supervisor_id', 'id');
    }
}
