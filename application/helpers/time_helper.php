<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function time_ago($datetime)
{
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) {
        return 'Baru saja';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' menit yang lalu';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' jam yang lalu';
    } else {
        $days = floor($diff / 86400);
        return $days . ' hari yang lalu';
    }
}


    function format_bulan($timestamp) {
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $tanggal   = date('d', strtotime($timestamp));
        $bulanNum  = date('m', strtotime($timestamp));
        $tahun     = date('Y', strtotime($timestamp));
        $jam       = date('H:i:s', strtotime($timestamp));

        return $tanggal . ' ' . $bulan[$bulanNum] . ' ' . $tahun . ' ' . $jam;
    }
?>