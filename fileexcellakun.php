<?php

session_start();

// Membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Harap Login Terlebih Dahulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// Membatasi halaman sesuai user login
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses');
            document.location.href = 'menutentang.php';
          </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Username');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Password');
$sheet->setCellValue('F1', 'Level');

// Mengambil data dari database
$data_akun = select("SELECT * FROM akun");

$no = 1;
$start = 2;

foreach ($data_akun as $akun) {
    $sheet->setCellValue('A' . $start, $no++);
    $sheet->setCellValue('B' . $start, $akun['nama']);
    $sheet->setCellValue('C' . $start, $akun['username']);
    $sheet->setCellValue('D' . $start, $akun['email']);
    $sheet->setCellValue('E' . $start, $akun['password']);
    $sheet->setCellValue('F' . $start, $akun['level']);
    $start++;
}

// Mengatur auto-size untuk kolom
foreach (range('A', 'F') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Style untuk border tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;
$sheet->getStyle('A1:F' . $border)->applyFromArray($styleArray);

// Output langsung ke browser (tanpa menyimpan file sementara)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Laporan_Data_Akun.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output'); // Langsung output ke browser
exit;
