<?php

namespace App\Helpers;

use DB;
use Route;

class General
{
    public static function countRawTable($table)
    {
        return DB::table($table)->count();
    }

    public static function format_message($message, $type)
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>' . $message . ' </strong>
    </div>';
    }

    public static function is_current_route($uri, $output = 'current-page')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }

    public static function nama_hari($hari)
    {
        $exHari = explode(',', $hari);
        switch ($exHari[0]) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return "<b>" . $hari_ini . "</b>," . $exHari[1];
    }

}
