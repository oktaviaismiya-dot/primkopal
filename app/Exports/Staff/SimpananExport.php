<?php

namespace App\Exports\Staff;

use App\Models\Simpanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SimpananExport implements FromView
{
    protected $month;
    protected $jenis;

    public function __construct($month, $jenis)
    {
        $this->month = $month;
        $this->jenis = $jenis;
    }

    public function view(): View {
        $simpanans = Simpanan::with(['user', 'jenisSimpanan'])
            ->when($this->month, function($query) {
                return $query->whereMonth('tanggal', $this->month);
            })
            ->when($this->jenis, function($query) {
                return $query->where('jenis_simpanan_id', $this->jenis);
            })
            ->get();

        return view('pages.staff.data-simpanan.SimpananExport', [
            'simpanans' => $simpanans
        ]);
    }
}
