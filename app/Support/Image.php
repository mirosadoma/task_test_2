<?php

namespace App\Support;

class Image {

    public function FileUpload($image,$path,$deleteImage=false,$fullpath="") {
        if ($deleteImage !== false) {
            $this->DeleteImage($fullpath);
        }
        $destinationPath = (is_null($path))? public_path('uploads'):public_path('uploads/'.$path);
        $mm = (is_null($path))?'uploads' :'uploads/'.$path;
        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $imageName = rand(1,5000).'_'.time().'.'.$image->extension();
        $image->move($destinationPath, $imageName);
        return $mm.'/'.$imageName;
    }

    public function DeleteImage($path)
    {
        if(!is_null($path)){
            $path = str_replace('/', '\\', $path);
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }
}
