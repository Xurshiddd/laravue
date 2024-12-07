<?php

namespace App\Services;

class ImageUpload
{
    public function oneImage($image, $path)
    {
        // Ensure the path exists, create if it doesn't
        $upload_path = public_path($path);
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Generate a unique file name
        $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Move the file to the directory
        $image->move($upload_path, $image_name);

        // Return the file name
        return $image_name;
    }
}

