<?php

namespace App\Traits;

/**
 * Trait UploadImageTrait
 *
 * @package App\Traits
 */
trait UploadImageTrait
{
    /**
     * @param $folder
     * @param $file
     * @return string
     */
    public function uploadImage($folder, $file)
    {
        $fileExtension = $file->extension();
        $fileName = time()."_".md5(rand(0, 9999)).".".$fileExtension;
        $uploadPath = public_path('/images/'.$folder);
        if ($file->move($uploadPath, $fileName)) {
            return $fileName;
        }
    }
}