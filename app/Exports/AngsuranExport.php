<?php

namespace App\Exports;

use App\Models\Angsuran;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AngsuranExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Angsuran::with(['formulirPengajuan.user'])->get();
    }

    public function map($angsuran): array
    {
        return [
            $angsuran->formulirPengajuan->user->username ?? 'N/A',
            $angsuran->tanggal,
            $angsuran->angsuran_ke,
            $angsuran->jumlah_bayar,
            $angsuran->sisa_pembayaran,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Anggota',
            'Tanggal Bayar',
            'Angsuran Ke',
            'Jumlah Bayar',
            'Sisa Pembayaran'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Jumlah Bayar
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Sisa Pembayaran
        ];
    }
}
