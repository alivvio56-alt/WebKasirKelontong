<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function rupiah($angka)
{
    return 'Rp ' . number_format((float) $angka, 0, ',', '.');
}

function tanggal_indonesia($tanggal)
{
    if (!$tanggal) {
        return '-';
    }

    return date('d/m/Y H:i', strtotime($tanggal));
}
