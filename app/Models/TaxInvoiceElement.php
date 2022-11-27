<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class TaxInvoiceElement extends Model
{
    protected $table = "tax_invoice_elements";

    protected $fillable = [
        'tax_id','product_id','weight','karat','count','gram_price','amount','tax','total'
    ];

    public function TaxInvoice()
    {
        return $this->belongsTo('\App\Models\TaxInvoice', 'tax_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id', 'id');
    }


}
