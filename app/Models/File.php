<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pdf_file',
    ];
    
    //  قمنا بتحديد حقل 
    // pdf_file
    //  كحقل يمكن تعبئته
    // وقمنا بإنشاء دالة 
    // setPdfFileAttribute
    //  للتحقق من نوع الملف قبل تعبئته
    // إذا كان الملف من نوع 
    // UploadedFile
    //  (PDFملف ) مثل 
    // سيتم حفظ الملف في مجلد 
    // pdf_files 
    public function setPdfFileAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $this->attributes['pdf_file'] = $value->store('pdf_files');
        }
    }
    
}
