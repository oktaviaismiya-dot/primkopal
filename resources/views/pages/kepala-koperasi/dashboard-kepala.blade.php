@extends('main')

@section('title', 'Dashboard Kepala Koperasi')

@section('content')
    <h3 class="dashboard-heading">Selamat Datang, Kepala Koperasi</h3>

    <div class="cards">
        <div class="card">
            <div class="card-title">
                <i class="ph ph-users"></i>
                <p>Pengajuan Baru</p>
            </div>
            <span>{{ $jumlahPengajuanBaru }}</span>
            <small class="trend up">Menunggu validasi</small>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="ph ph-check-circle"></i>
                <p>Terverifikasi</p>
            </div>
            <span>{{ $jumlahPengajuanTerverifikasi }}</span>
            <small class="trend up">Total disetujui</small>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="ph ph-x-circle"></i>
                <p>Ditolak</p>
            </div>
            <span>{{ $jumlahPengajuanDitolak }}</span>
            <small class="trend up">Total ditolak</small>
        </div>
    </div>

    <div class="card card-table">
        <h3>Validasi Slip Gaji</h3>
        <p>Daftar pengajuan anggota yang perlu divalidasi berdasarkan slip gaji.</p>

        <table class="validation-table">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Slip Gaji</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuans as $item)
                    @php
                        $data = json_decode($item->data_lengkap_json, true);
                    @endphp
                    <tr>
                        <td>{{ $item->user->username }}</td>
                        <td>Rp {{ number_format($data['jumlah_pinjaman'], 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $data['slip_gaji_path']) }}" target="_blank">Lihat Slip</a>
                        </td>
                        <td>
                            @if ($item->status == 'pending')
                                <span class="badge badge-pending" style="font-size: 0.75rem; color:#fff;">Pending</span>
                            @elseif ($item->status == 'disetujui')
                                <span class="badge badge-disetujui" style="font-size: 0.75rem; color:#fff;">Disetujui</span>
                            @elseif ($item->status == 'ditolak')
                                <span class="badge badge-ditolak" style="font-size: 0.75rem; color:#fff;">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 'dipending')
                                <form action="{{ route('pengajuan.validasi', $item->id) }}" method="POST"
                                    style="display: inline-block">
                                    @csrf
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="btn btn-success btn-sm"
                                        style="margin-top: 0px;">Validasi</button>
                                </form>
                                <form action="{{ route('pengajuan.validasi', $item->id) }}" method="POST"
                                    style="display: inline-block; margin-left: 5px;">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        style="margin-top: 0px;">Tolak</button>
                                </form>
                            @elseif ($item->status == 'disetujui')
                                <form action="{{ route('pengajuan.validasi', $item->id) }}" method="POST"
                                    style="display: inline-block; margin-left: 5px;">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        style="margin-top: 0px;">Tolak</button>
                                </form>
                            @elseif ($item->status == 'ditolak')
                                <form action="{{ route('pengajuan.validasi', $item->id) }}" method="POST"
                                    style="display: inline-block; margin-left: 5px;">
                                    @csrf
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="btn btn-success btn-sm"
                                        style="margin-top: 0px;">Validasi</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
            width: fit-content;
        }

        .badge-pending {
            background: #ffc107;
            color: #000;
        }

        .badge-disetujui {
            background: #28a745;
            color: #fff;
        }

        .badge-ditolak {
            background: #dc3545;
            color: #fff;
        }

        .dashboard-heading {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 30%;
            min-width: 250px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            color: #000;
        }

        .card-title i {
            font-size: 24px;
            color: #000;
        }

        .card span {
            display: block;
            font-size: 22px;
            margin-bottom: 5px;
            color: #222;
        }

        .trend {
            font-size: 13px;
        }

        .trend.up {
            color: green;
        }

        .trend.neutral {
            color: orange;
        }

        .card-table {
            margin-top: 20px;
        }

        .validation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .validation-table th,
        .validation-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .validation-table th {
            background-color: #f5f5f5;
            color: #333;
        }

        .validation-table tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
@endsection
