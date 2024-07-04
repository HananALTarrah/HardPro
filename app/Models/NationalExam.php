<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
class NationalExam extends Model
{
    use HasFactory;

    protected $table='nationalexams';
    
    protected $fillable = [
        'name',
        'path' 
    ];
    

    // أي ريكويست هأعمل فيه سيليكت مش هترجع معايا
    protected $hidden = [];


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
    // public function setPdfFileAttribute($value)
    // {
    //     if ($value instanceof UploadedFile) {
    //         $this->attributes['file'] = $value->store('nationalexam_files');
    //     }
    // }

    public static function uploadFile($model)
    {
        if($request->hasFile('file')){

            // عم نعمل حذف للمسار القديم
        if(!empty($nationalexams->file)&& Storage::exists($nationalexams->file))
          {
            Storage::delete($nationalexams->file);
          }
          static::deleteFile($model);
        //   عم نحط المسار الجديد مكان القديم
        $model->file=$request->file('file')->store('nationalexams');
        }
    }

    public static function deleteFile($model)
    {
        if(!empty($model->file)&& Storage::exists($model->file))
        {
          Storage::delete($model->file);
        }
    }
}
