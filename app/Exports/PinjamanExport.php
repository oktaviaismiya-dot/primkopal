<?php

namespace App\Exports;

use App\Models\FormulirPengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PinjamanExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        return FormulirPengajuan::with('user')->get()->map(function ($item) {
            $data = json_decode($item->data_lengkap_json, true);
            return [
                $item->user->username,
                $item->created_at->format('d/m/Y'),
                $data['jumlah_pinjaman'],
                $item->status,
                $data['keperluan'],
                $data['bunga'],
                $data['tenor']
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tanggal Pengajuan',
            'Jumlah Pinjaman',
            'Status',
            'Keperluan',
            'Bunga',
            'Tenor'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold heading (baris ke-1)
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // Tambahkan border untuk semua sel (dari A1 ke G + jumlah baris)
        $rowCount = FormulirPengajuan::count() + 1; // +1 karena ada heading
        $sheet->getStyle("A1:G$rowCount")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}
