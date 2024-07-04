<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table='tests';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    // أي ريكويست هأعمل فيه سيليكت مش هترجع معايا
    protected $hidden = [];

}
