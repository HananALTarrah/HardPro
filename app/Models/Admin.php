<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// لأجل اي مودل بيعمل لوغإن و ريجستر هيإكستند من الأوثينتيكيتبل وليس من المودل
// class Admin extends Model


class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table='admins';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tests()
    {
        return $this->hasMany(Test::class, 'admin_id');
    }
}
