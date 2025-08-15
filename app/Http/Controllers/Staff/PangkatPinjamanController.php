<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PangkatPinjamanController extends Controller
{
    public function index()
    {
        return view('pages.staff.pangkat-pinjaman.index');
    }
}