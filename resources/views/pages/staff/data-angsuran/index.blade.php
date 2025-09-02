@extends('main')

@section('title', 'Data Angsuran')

@section('content')
    <div class="dashboard-header">
        <h3>Data Angsuran</h3>
    </div>

    <div class="table-wrapper">
        <div class="table-actions">
            <div class="filter-container">
                <form action="{{ route('data-angsuran.index') }}" method="GET" class="filter-form">
                    <label for="month">Filter Bulan:</label>
                    <select name="month" id="month" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </form>
                <a href="{{ route('data-angsuran.index') }}" class="btn-reset">Reset Filter</a>
                <div style="margin-top: 0px;">
                    <a href="{{ route('data-angsuran.export', request()->all()) }}" class="btn-reset"
                        style="background:green; font-size:0.8rem;">Export Excel</a>
                </div>
            </div>
            <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Sisa Pinjaman</th>
                    <th>Ke-</th>
                    <th>Angsuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($angsuranList as $index => $angsuran)
                    @php
                        $data = json_decode($angsuran->formulirPengajuan->data_lengkap_json, true);
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $angsuran->formulirPengajuan->user->username ?? 'N/A' }}</td>
                        <td>{{ Carbon\Carbon::parse($angsuran->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td>Rp {{ number_format($data['jumlah_pinjaman'], 0, ',', '.') }}
                            <br>
                            <small style="color:gray;">
                                (Pengajuan:
                                {{ \Carbon\Carbon::parse($angsuran->formulirPengajuan->created_at)->format('d-m-Y') }})
                            </small>
                        </td>
                        <td>Rp {{ number_format($angsuran->sisa_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $angsuran->angsuran_ke ?? '-' }}</td>
                        <td>Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td> <button onclick="editAngsuran({{ $angsuran->id }})">Ubah</button>
                            <form action="{{ route('data-angsuran.destroy', $angsuran->id) }}" method="POST"
                                style="display:inline;"> @csrf @method('DELETE') <button type="submit"
                                    onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button> </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            <ul class="pagination">
                {{-- Tombol Previous --}}
                @if ($angsuranList->onFirstPage())
                    <li class="disabled"><span>Previous</span></li>
                @else
                    <li><a href="{{ $angsuranList->previousPageUrl() }}">Previous</a></li>
                @endif

                {{-- Nomor halaman --}}
                @foreach ($angsuranList->getUrlRange(1, $angsuranList->lastPage()) as $page => $url)
                    @if ($page == $angsuranList->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($angsuranList->hasMorePages())
                    <li><a href="{{ $angsuranList->nextPageUrl() }}">Next</a></li>
                @else
                    <li class="disabled"><span>Next</span></li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addModal')">&times;</span>
            <h3>Tambah Angsuran</h3>
            <form action="{{ route('data-angsuran.store') }}" method="POST">
                @csrf
                <label>Nama</label>
                <select name="formulir_pengajuan_id" required>
                    @foreach ($formulirs as $p)
                        @php
                            $data = json_decode($p->data_lengkap_json, true);
                        @endphp
                        <option value="{{ $p->id }}">{{ $p->user->username ?? 'N/A' }} - Pinjaman : Rp.
                            {{ number_format($data['jumlah_pinjaman'], 0, ',', '.') }}</option>
                    @endforeach
                </select>

                <label>Tanggal Bayar</label>
                <input type="date" name="tanggal" required>

                <label>Jumlah Angsuran</label>
                <input type="number" name="jumlah_bayar" required>

                <label>Angsuran Ke-</label>
                <input type="number" name="angsuran_ke" required>

                <div style="text-align:center; margin-top:10px;">
                    <button type="submit" style="color:white; background:dodgerblue;">Simpan</button>
                    <button type="button" onclick="closeModal('addModal')"
                        style="color:white; background:darkgray;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editModal')">&times;</span>
            <h3>Ubah Angsuran</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <label>Tanggal</label>
                <input type="date" name="tanggal" id="editTanggal" required>

                <label>Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" id="editJumlah" required>

                <label>Angsuran Ke-</label>
                <input type="number" name="angsuran_ke" id="editKe" required>

                {{-- <label>Status</label>
                <select name="status" id="editStatus" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Tertunda">Tertunda</option>
                </select> --}}


                <div style="text-align:center; margin-top:10px;">
                    <button type="submit" style="color:white; background:orangered;">Update</button>
                    <button type="button" onclick="closeModal('editModal')"
                        style="color:white; background:darkgray;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('viewModal')">&times;</span>
            <h3>Detail Angsuran</h3>
            <p><strong>Nama:</strong> <span id="viewNama"></span></p>
            <p><strong>Tanggal:</strong> <span id="viewTanggal"></span></p>
            <p><strong>Jumlah Bayar:</strong> Rp <span id="viewJumlah"></span></p>
            <p><strong>Angsuran Ke:</strong> <span id="viewKe"></span></p>
            <p><strong>Sisa Pembayaran:</strong> <span id="viewSisaBayar"></span></p>
        </div>
    </div>

    <style>
        .filter-container {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-right: auto;
        }

        .filter-form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .filter-form label {
            margin: 0;
            font-weight: normal;
        }

        .btn-reset {
            padding: 6px 12px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-reset:hover {
            background-color: #5a6268;
        }

        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }

        .table-actions select {
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
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

        .modal-content label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modal-content button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .modal-content button:hover {
            background-color: #2980b9;
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

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function editAngsuran(id) {
            fetch(`/data-angsuran/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('editForm').action = `/data-angsuran/${id}`;
                    document.getElementById('editTanggal').value = data.tanggal;
                    document.getElementById('editJumlah').value = data.jumlah_bayar;
                    document.getElementById('editKe').value = data.angsuran_ke;
                    // document.getElementById('editStatus').value = data.status;
                    openModal('editModal');
                });
        }

        function viewDetail(id) {
            fetch(`/data-angsuran/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('viewNama').textContent = data.username ?? 'N/A';
                    document.getElementById('viewTanggal').textContent = data.tanggal;
                    document.getElementById('viewJumlah').textContent = new Intl.NumberFormat('id-ID').format(data
                        .jumlah_bayar);
                    document.getElementById('viewKe').textContent = data.angsuran_ke;
                    document.getElementById('viewSisaBayar').textContent = new Intl.NumberFormat('id-ID').format(data
                        .sisa_pembayaran);
                    openModal('viewModal');
                });
        }

        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) modal.style.display = "none";
            });
        };
    </script>
@endsection
