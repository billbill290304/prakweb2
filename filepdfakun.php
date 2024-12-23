<?php

require __DIR__.'/vendor/autoload.php';
require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

// Mengambil data dari database
$data_akun = select("SELECT * FROM akun");

// Inisialisasi konten HTML untuk PDF
$content = '
<page>
    <h1>Laporan Data Akun</h1>
    <table border="1" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>';

// Menambahkan data akun ke dalam tabel
$no = 1;
foreach ($data_akun as $akun) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . htmlspecialchars($akun['nama']) . '</td>
            <td>' . htmlspecialchars($akun['username']) . '</td>
            <td>' . htmlspecialchars($akun['email']) . '</td>
            <td>' . htmlspecialchars($akun['password']) . '</td>
            <td>' . htmlspecialchars($akun['level']) . '</td>
        </tr>';
}

$content .= '
        </tbody>
    </table>
</page>';

// Membuat PDF
$html2pdf = new Html2Pdf('L');
$html2pdf->writeHTML($content);

// Mengatur header agar file langsung diunduh
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Laporan Data Akun.pdf"');

// Output PDF
$html2pdf->output('Laporan Data Akun.pdf', 'D');