<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class TaxInvoice extends Model
{
    protected $table = "tax_invoices";

    protected $fillable = [
        'unified_serial_number','company_name','company_tax_number','date','time','payment_method','cash_amount','visa_amount','branch_id','supervisor_id',
        'total_count','total_weight','gram_total_price','amount_total','tax_total','final_total','status'
    ];

    public function branch(){
        return $this->belongsTo('\App\Models\Branch','branch_id','id');
    }

    public function supervisor(){
        return $this->belongsTo('\App\Models\Supervisor','supervisor_id','id');
    }
    public function elements(){
        return $this->hasMany('\App\Models\TaxInvoiceElement','tax_id','id');
    }


}
