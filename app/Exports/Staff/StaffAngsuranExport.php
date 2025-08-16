<?php

namespace App\Exports\Staff;

use App\Models\Angsuran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StaffAngsuranExport implements FromView
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $angsuranList = Angsuran::with('formulirPengajuan.user')
            ->when($this->month, function ($query) {
                return $query->whereMonth('tanggal', $this->month);
            })
            ->get();
        return view('pages.staff.data-angsuran.angsuranExport', [
            'angsuranList' => $angsuranList,
        ]);
    }
}
