@extends('main')

@section('title', 'Data Angsuran')

@section('content')
    <div class="dashboard-header">
        <h3>Data Angsuran</h3>
    </div>

    <div class="table-wrapper">
        <div class="table-actions">
            <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($angsuranList as $index => $angsuran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $angsuran->formulirPengajuan->user->username ?? 'N/A' }}</td>
                        <td>{{ $angsuran->tanggal }}</td>
                        <td>Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $angsuran->angsuran_ke ?? '-' }}</td>
                        <td>Rp {{ number_format($angsuran->sisa_pembayaran, 0, ',', '.') }}</td>
                        <td>
                            <button onclick="viewDetail({{ $angsuran->id }})">Lihat</button>
                            <button onclick="editAngsuran({{ $angsuran->id }})">Ubah</button>
                            <form action="{{ route('data-angsuran.destroy', $angsuran->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                        <option value="{{ $p->id }}">{{ $p->user->username ?? 'N/A' }}</option>
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
