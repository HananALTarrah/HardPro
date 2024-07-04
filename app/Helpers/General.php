<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

// ميثود لحفظ الصور
// بتاخد الفولد يلي انا عاوز حط فيه الصور مثل الرايترز و الصورة نفسها

    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $fileName = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }

    function uploadFile($folder, $file)
    {
        $file->store('/', $folder);
        $fileName = $file->hashName();
        $path = 'files/' . $folder . '/' . $filename;
        return $path;
    }

