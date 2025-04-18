<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_bulan')) {
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

}
?>