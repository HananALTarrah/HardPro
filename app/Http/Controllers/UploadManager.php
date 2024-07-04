<?php
// https://youtu.be/HNRF2a4ixQo?si=x_Prf9Sa9UGDVTOC
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadManager extends Controller
{
    //
    public function upload()
    {
        return view('upload');

    }

    public function uploadPost(Request $request)
    {
  // حتى نتمكن من استلام الملف الذي نرسله من جزء العرض
    // أحتاج لإضافة اسم الملف
    $file=$request->file("file");
    echo 'File Name: ' .$file->getClientOriginalName();
    echo '<br>';
    echo 'File Extentsion: ' .$file->getClientOriginalExtension();
    echo '<br>';
    echo 'File Path: ' .$file->getRealPath();
    echo '<br>';
    echo 'File Size: ' .$file->getSize();
    echo '<br>';
    echo 'File Mime Type: ' .$file->getMimeType();
    echo '<br>';
    $destinationPath="upload";
    if($file->move($destinationPath,$file->getClientOriginalName()))
    {
        echo "File Upload Success";
    }
    else
        echo "Faild to upload file";
    }

  
}
