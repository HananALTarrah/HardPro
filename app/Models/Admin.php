<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// لأجل اي مودل بيعمل لوغإن و ريجستر هيإكستند من الأوثينتيكيتبل وليس من المودل
// class Admin extends Model
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table='admins';
    protected $fillable = [
        'name',
        'email',
        'password',
        // الصورة يمكن تكون نلل و بس يفوت الدير عالبروفايل تبعو بحط صورة
        'photo',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
