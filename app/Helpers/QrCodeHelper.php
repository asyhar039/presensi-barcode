<?php

namespace App\Helpers;


class QrCodeHelper
{
    /**
     * Generate QR Code in SVG format
     *
     * @noinspection PhpUndefinedClassInspection
     */
    public static function generate(string $text, int $size = 200): string
    {
        // resolve the QR code generator from the container to avoid facade import issues
        // use string to avoid analyzer complaining about external class
        $generator = app('SimpleSoftwareIO\QrCode\Generator');
        return $generator->size($size)->generate($text);
    }
}
