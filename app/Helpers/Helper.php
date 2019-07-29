<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\ImageManagerStatic as Image;

use Session;
use Storage;
use File;

class Helper {

	/**
     * generate key for random name
     * @return String
     */
    public static function getRandomName() {
        return uniqid('CNAF-' . date('Ymd') . '-IMAGE-' . md5(uniqid(rand(), true)));
    }

    public static function getInvoiceRandomName() {
        return 'INVOICE-' . date('Ymd') . '-SCR-' . substr(md5(uniqid(rand(), true)), -6);
    }

    /**
     * set location for public directory
     * @param String $directory
     * @param File $filename
     */
    public static function setDirectoryUpload($directory) {
        // return public_path($directory . $filename);
        $constants = Config::get('constants');
        $path = $constants['UPLOAD_PATH'] . $directory;

        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    public static function interventionUploadImage($picture = null, $size = array('width', 'height'), $directory = 'items') {
        if ($picture != null) {
            $random_name = Helper::getRandomName();
            $extension = $picture->getClientOriginalExtension();
            $filename = $random_name . '.' . $extension;
            $location = Helper::setDirectoryUpload($directory);

            // $width = $size['width'];
            // $height = $size['height'];

            $picture->move($location, $filename);

            /*if ($width != null || $width != '' && $height != null || $height != '') {
                Image::make($picture)->resize($width, $height)->save($location);
            } else {
                Image::make($picture)->save($location);
            }*/

            return Config::get('constants')['LINK_PATH'] . "$directory/$filename";
        } else {
            return null;
        }

        /* Sebelumnya ga pake statement if else, langsung execute */
    }

    public static function number_format($n, $precision = 1) {
        if ($n < 900) {
            /* 0 - 900 */
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            /* 0.9k-850k */
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'Rb';
        } else if ($n < 900000000) {
            /* 0.9m-850m */
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'Jt';
        } else if ($n < 900000000000) {
            /* 0.9b-850b */
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'M';
        } else {
            /* 0.9t+ */
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        /* Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1" */
        /* Intentionally does not affect partials, eg "1.50" -> "1.50" */

        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . ' ' . $suffix;
    }

    public static function date_remaining($tikettime) {
        $diff = abs(strtotime(Carbon\Carbon::now()) - strtotime($tikettime));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60* 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24)/ (60 * 60 * 24));

        printf("%d years, %d months, %d days\n", $years, $months, $days);
    }
}