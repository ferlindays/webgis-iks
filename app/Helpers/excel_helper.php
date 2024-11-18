<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Create an Excel file from array data.
 *
 * @param string $filename The path to save the file.
 * @param array $data The data to write to the Excel file, where each item is an array.
 * @param array $header Header data, where each item is a string. Default is an empty array.
 *
 * @return void
 */
function createExcelFile($filename, $data, $header = [])
{
    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray($header, null, 'A1');

    $row = 2;
    foreach ($data as $item) {
        $sheet->fromArray($item, null, 'A' . $row);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    $filename = $filename . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}
