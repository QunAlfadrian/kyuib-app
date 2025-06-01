<?php

namespace App\Services\V1;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService {
    /**
     * Create a new class instance.
     */
    public function __construct() {
        //
    }

    public function StoreImage(
        UploadedFile $file,
        string $filename,
        string $path,
        int $quality=75
    ) {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $webp = $image->toWebp($quality);
        Storage::disk('public')->put($path.$filename, $webp);
    }
}
