@extends('main')

@section('title', 'Data Angsuran')

@section('content')

    <div class="dashboard-header">
        <h3>Data Angsuran</h3>
    </div>

    <div class="table-wrapper">
        <div class="table-actions">
            <a href="{{ route('data.angsuran.export.kop') }}" class="btn-export">
                Export Excel
            </a>
        </div> 

        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Angsuran</th>
                    <th>Ke-</th>
                    <th>Sisa Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($angsurans as $index => $angsuran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $angsuran->formulirPengajuan->user->username ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($angsuran->tanggal)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $angsuran->angsuran_ke }}</td>
                        <td>Rp {{ number_format($angsuran->sisa_pembayaran ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada angsuran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <style>
        .btn-export {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
        }

        .btn-export:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) modal.style.display = "none";
            });
        };
    </script>
@endsection
