<?php

namespace App\Http\Helpers;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Core\FileManager;

class ProductHelper
{
    /**
     * get image path of course
     *
     * @param $imageName
     * @return string
     */

    public static function getProductImagePath($imageName)
    {
        $file = asset('images/default-image.png');
        if (null != $imageName) {
            if (FileManager::checkFileExist($imageName, FileDestinations::PRODUCT_IMAGE)) {
                $file = FileManager::getFileUrl($imageName, FileDestinations::PRODUCT_IMAGE);
            }
        }
        return $file;
    }
}
