<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        if (is_array($imageFile)) {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }
        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;
        $width = 1920;
        $height = 1080;
        $resizedImage = InterventionImage::make($file)->resizeCanvas($width, $height)->encode();
        Storage::put('public/'.$folderName.'/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
}
