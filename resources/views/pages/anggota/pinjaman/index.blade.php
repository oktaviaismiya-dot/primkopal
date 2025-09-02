@extends('main')

@section('title', 'Data Pinjaman')

@section('content')
    <div class="dashboard-header">
        <h3>Data Pinjaman</h3>
    </div>

    <div class="table-wrapper">
        <div class="table-actions">
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Keperluan</th>
                    <th>Bunga</th>
                    <th>Tenor</th>
                    <th>Total Bunga</th>
                    <th>Total Bayar</th>
                    <th>Angsuran/Bulan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinjaman as $index => $pinjam)
                    @php
                        $data = json_decode($pinjam->data_lengkap_json, true);

                        $jumlah = $data['jumlah_pinjaman'];
                        $bunga = (float) $data['bunga'] / 100;;
                        $tenor = (int) $data['tenor'];

                        $totalBunga = $jumlah * $bunga * $tenor;
                        $totalBayar = $jumlah + $totalBunga;

                        $angsuran = $totalBayar / $tenor;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pinjam->user->username }}</td>
                        <td>{{ $pinjam->created_at_formatted }}</td>
                        <td>Rp {{ number_format($data['jumlah_pinjaman'], 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $pinjam->status }}">
                                {{ ucfirst($pinjam->status) }}
                            </span></td>
                        <td>{{ $data['keperluan'] }}</td>
                        <td>{{ (float) $data['bunga'] }}%</td>
                        <td>{{ $data['tenor'] }} Bulan</td>
                        <td>{{ number_format($totalBunga, 0, ',', '.') }}</td>
                        <td>{{ number_format($totalBayar, 0, ',', '.') }}</td>
                        <td>{{ number_format($angsuran, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            <ul class="pagination">
                {{-- Tombol Previous --}}
                @if ($pinjaman->onFirstPage())
                    <li class="disabled"><span>Previous</span></li>
                @else
                    <li><a href="{{ $pinjaman->previousPageUrl() }}">Previous</a></li>
                @endif

                {{-- Nomor halaman --}}
                @foreach ($pinjaman->getUrlRange(1, $pinjaman->lastPage()) as $page => $url)
                    @if ($page == $pinjaman->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($pinjaman->hasMorePages())
                    <li><a href="{{ $pinjaman->nextPageUrl() }}">Next</a></li>
                @else
                    <li class="disabled"><span>Next</span></li>
                @endif
            </ul>
        </div>
    </div>

    <style>
        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content h3 {
            margin-top: 0;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .modal-content p {
            margin-bottom: 8px;
        }

        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
            margin-top: -10px;
            margin-right: -5px;
        }

        .close:hover {
            color: #000;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: capitalize;
        }

        .badge-pending {
            background-color: #ffc107;
            /* kuning */
            color: #000;
        }

        .badge-disetujui {
            background-color: #28a745;
            /* hijau */
            color: #fff;
        }

        .badge-diproses {
            background-color: #007bff;
            /* biru */
            color: #fff;
        }

        .badge-ditolak {
            background-color: #dc3545;
            /* merah */
            color: #fff;
        }

         .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: end;
        }

        .pagination {
            list-style: none;
            display: flex;
            gap: 5px;
            padding: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: block;
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #007bff;
            transition: background 0.2s;
        }

        .pagination a:hover {
            background: #007bff;
            color: #fff;
        }

        .pagination .active span {
            background: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: default;
        }

        .pagination .disabled span {
            color: #aaa;
            border-color: #ddd;
            cursor: not-allowed;
        }
    </style>
@endsection
