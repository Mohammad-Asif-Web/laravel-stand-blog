<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PhotoUploadController extends Controller
{
    public static function imageUpload($name, $height, $width, $path, $file)
    {
        $manager = new ImageManager(new Driver());
        // ata hocche full imager nam
        $image_name = $name.'.webp';
        $img = $manager->read($file);
        $img = $img->resize($width,$height)->save(public_path($path).$image_name, 50, 'webp');
        return $image_name;
    }

    public static function imageUnlink($path, $name)
    {
        $image_path = public_path($path).$name;
        if(file_exists($image_path)){
            unlink($image_path);
        }
    }
}
