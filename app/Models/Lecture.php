<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecture_title','lecture_file','admin_id'
     ];

    //  لجلب المادة الخاصة بمحاضرة معينة
    // one-to-many
     // كل محاضرة ستكون تابعة لمادة و كل مادة يمكن أن يكون لديها محاضرة أو أكثر
     public function subject(){
        return $this->belongsTo(Subject::class);
    //   هذا الكاتب يكتب مادة واحدة
        // مسار المودل , المفتاح الأجنبي , المفتاح الرئيسي في جدول المادة

    }
}
