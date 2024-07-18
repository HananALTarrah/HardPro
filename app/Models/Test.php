<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table='tests';
    protected $fillable = [
        'name', 'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    // أي ريكويست هأعمل فيه سيليكت مش هترجع معايا
    // protected $hidden = [];

}
