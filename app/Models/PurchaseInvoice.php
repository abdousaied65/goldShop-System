<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 * @method static whereBetween(string $string, array $array)
 */
class PurchaseInvoice extends Model
{
    protected $table = "purchases_invoices";
    protected $fillable = [
        'invoice_number','date','branch_id','supervisor_id','employee_id','tax_total','final_total','attachment'
    ];

    public function branch()
    {
        return $this->belongsTo('\App\Models\Branch', 'branch_id', 'id');
    }

    public function supervisor()
    {
        return $this->belongsTo('\App\Models\Supervisor', 'supervisor_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee', 'employee_id', 'id');
    }

}
