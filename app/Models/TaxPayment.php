<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class TaxPayment extends Model
{
    protected $table = "tax_payments";
    protected $fillable = [
        'tax_id',
        'payment_method',
        'amount',
    ];
    public function tax(){
        return $this->belongsTo('\App\Models\TaxInvoice','tax_id','id');
    }

}
