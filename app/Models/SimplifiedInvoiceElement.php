<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class SimplifiedInvoiceElement extends Model
{
    protected $table = "simplified_invoice_elements";

    protected $fillable = [
        'simplified_id','product_id','weight','karat','count','gram_price','amount','tax','total'
    ];

    public function simplified()
    {
        return $this->belongsTo('\App\Models\SimplifiedInvoice', 'simplified_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id', 'id');
    }


}
