<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class SimplifiedPayment extends Model
{
    protected $table = "simplified_payments";
    protected $fillable = [
        'simplified_id',
        'payment_method',
        'amount',
    ];
    public function simplified(){
        return $this->belongsTo('\App\Models\SimplifiedInvoice','simplified_id','id');
    }

}
