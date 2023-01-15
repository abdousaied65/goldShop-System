<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail($admin_id)
 */
class SimplifiedReturn extends Model
{
    protected $table = "simplified_returns";
    
    // public $timestamps = false;
    const UPDATED_AT = null;

    protected $fillable = [
        'simplified_id','unified_serial_number','employee_id','date','time','notes','branch_id','supervisor_id'
    ];

    public function simplified()
    {
        return $this->belongsTo('\App\Models\SimplifiedInvoice', 'simplified_id', 'id');
    }

    public function branch(){
        return $this->belongsTo('\App\Models\Branch','branch_id','id');
    }

    public function supervisor(){
        return $this->belongsTo('\App\Models\Supervisor','supervisor_id','id');
    }

    public function employee()
    {
        return $this->belongsTo('\App\Models\Employee', 'employee_id', 'id');
    }

}
