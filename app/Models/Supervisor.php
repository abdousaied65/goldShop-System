<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class Supervisor extends Authenticatable
{
    use Notifiable,HasRoles;
    protected $table = 'supervisors';
    protected $guard = 'supervisor-web';
    protected $guard_name = 'supervisor-web';
    protected $fillable = [
        'name','email', 'password','role_name','Status','phone_number','profile_pic','branch_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
        'email_verified_at'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, 'supervisor.password.reset', 'supervisors'));
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('supervisor.verification.verify'));
    }

    public function branch(){
        return $this->belongsTo('\App\Models\Branch','branch_id','id');
    }


}
