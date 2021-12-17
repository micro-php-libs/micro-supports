<?php

/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * **Usages**
 * Link: https://github.com/spatie/laravel-http-logger
 * Add to app/logging.php
 * ```
 * 'http' => [
'driver' => 'daily',
'path' => storage_path('logs/http-data-scraping-' . env('APP_ENV') . '-'.get_current_user().'.log'),
'level' => env('LOG_LEVEL', 'debug'),
'days' => env('LOG_DAILY_DAYS', 7),
'permission' => 0777,
],
 * ```
 * and modify config http-logger.php
 * ```
 * 'log_writer' => \MicroPhpLibs\MicroSupports\HttpLogCustom::class,
 * ```
 */

namespace MicroPhpLibs\MicroSupports\ServiceSupports;

class ImageImagickService
{

    public static function instance()
    {
        return new ImageImagickService();
    }

    /**
     * @param string $imageUrl
     * @param string $format
     * @return \Imagick
     */
    public function makeImageHighResolution(string $imageUrl, string $format = 'jpg')
    {
        return $this->makeImage($imageUrl, $format, 300);
    }

    /**
     * @param string $imageUrl
     * @param string $format
     * @param int $dpi
     * @return \Imagick
     * @throws \ImagickException
     */
    public function makeImageGrey(string $imageUrl, string $format = 'jpg', int $dpi = 300)
    {
        $imagick = new \Imagick($imageUrl);
        $imagickGrey = clone $imagick;
        $imagickGrey->setimagetype(\Imagick::IMGTYPE_GRAYSCALE);
        $imagickGrey->setImageResolution($dpi, $dpi);
        $imagickGrey->setImageFormat($format);

        return $imagickGrey;
    }

    /**
     * @param string $imageUrl
     * @param string $format
     * @param int $dpi
     * @return \Imagick
     * @throws \ImagickException
     */
    public function makeImage(string $imageUrl, string $format = 'jpg', int $dpi = 100)
    {
        $image = new \Imagick($imageUrl);
        // Using setSize before reading an image file tells ImageMagick to resize the image immediately on load -
        // this can give a substantial increase in performance time and save memory and disk resources for large images
        // $image->setSize($width, $height);
        //$image->setCompression(\Imagick::COMPRESSION_ZIP);
        //$image->setCompressionQuality(100);
        $image->setImageUnits(\Imagick::RESOLUTION_PIXELSPERINCH);
        // Make 300 dpi
        $image->setImageResolution($dpi, $dpi);
        $image->setImageFormat($format);

        return $image;
    }

    /**
     * @param string $base64Image
     * @return array
     */
    public function makeFromBase64($base64Image)
    {
        preg_match("/data:image\/(.*?);/", $base64Image,$imageExtension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/','', $base64Image); // remove the type part
        $image = str_replace(' ', '+', $image);
        return [$imageExtension[1], $image];
    }
}
