<?php

namespace App\Helpers;

class Helper
{
    /**
     * Description...
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public static function formatRupiah($angka, $decimal = 2)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, $decimal, ',', '.');

        return $hasil_rupiah;
    }
}

?>
