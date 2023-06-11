<?php

namespace App\Trait;

use Intervention\Image\ImageManager;

trait FileProcessorTrait
{
    public function imageUploader($uploadedImage, $location='images/', $height=500, $width=null){
        $imageManager = new ImageManager();
        $image = $imageManager->make($uploadedImage);

        // Resize the image
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Generate a unique filename for the resized image
        $filename = uniqid() . '.' . $uploadedImage->getClientOriginalExtension();

        // Save the resized image to the desired storage location
        $image->save(public_path($location . $filename));

        return $filename;
    }
}

