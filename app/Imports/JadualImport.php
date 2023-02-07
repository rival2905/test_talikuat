<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Jadual;

class JadualImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Jadual([
            'tanggal' => $row['Tanggal'],
            'no_mata_pembayaran' => $row['No. Mata Pembayaran'],
            'uraian' => $row['Uraian'],
            'satuan' => $row['Satuan'],
            'harga_satuan' => $row['Harga Satuan'],
            'volume' => $row['Volume'],
            'jumlah_harga' => $row['Jumlah Harga (Rp.)'],
            'bobot' => $row['Bobot'],
            'koefesien' => $row['Koefisien'],
            'nilai' => $row['Nilai']
        ]);
    }
}
