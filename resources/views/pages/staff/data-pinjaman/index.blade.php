@extends('main')

@section('title', 'Data Pinjaman')

@section('content')
    <div class="dashboard-header">
        <h3>Data Pinjaman</h3>
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
                    <th>Tanggal Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tenor</th>
                    <th>Status</th>
                    <th>Bunga</th>
                    <th>Slip Gaji</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuans as $key => $pengajuan)
                    @php $data = json_decode($pengajuan->data_lengkap_json); @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pengajuan->user->username ?? '-' }}</td>
                        <td>{{ $pengajuan->created_at->format('d F Y') ?? '-' }}</td>
                        <td>Rp {{ number_format($data->jumlah_pinjaman ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $data->tenor ?? '-' }} bulan</td>
                        <td>{{ ucfirst($pengajuan->status) }}</td>
                        <td>{{ $data->bunga }}</td>
                        <td>
                            @if (!empty($data->slip_gaji_path))
                                <a href="{{ asset('storage/' . $data->slip_gaji_path) }}" target="_blank">Lihat</a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addModal')">&times;</span>
            <h3>Tambah Pinjaman</h3>
            <form action="{{ route('data-pinjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <select name="user_id" required>
                        @foreach ($users as $p)
                            <option value="{{ $p->id }}">{{ $p->username ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jabatan">Pangkat</label>
                    <select id="jabatan" name="jabatan" required>
                        <option value="" selected disabled>Pilih pangkat</option>
                        <option value="tamtama">Tamtama - Maks Rp 10.000.000</option>
                        <option value="bintara">Bintara - Maks Rp 15.000.000</option>
                        <option value="perwira">Perwira - Maks Rp 20.000.000</option>
                        <option value="letkol">Letkol - Maks Rp 25.000.000</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="slip_gaji">Upload Slip Gaji</label>
                    <input type="file" name="slip_gaji" id="slip_gaji" required>
                </div>

                {{-- Jumlah Pinjaman --}}
                <div class="form-group">
                    <label for="jumlah_pinjaman">Jumlah Pinjaman (Rp)</label>
                    <input type="number" id="jumlah_pinjaman" name="jumlah_pinjaman" placeholder="Contoh: 5000000"
                        min="1000000" required>
                </div>

                {{-- Tenor --}}
                <div class="form-group">
                    <label for="tenor">Tenor (bulan)</label>
                    <select id="tenor" name="tenor" required>
                        <option value="12">12 bulan</option>
                        <option value="24">24 bulan</option>
                    </select>
                </div>

                {{-- Keperluan --}}
                <div class="form-group">
                    <label for="keperluan">Keperluan Pinjaman</label>
                    <textarea id="keperluan" name="keperluan" rows="4" placeholder="Contoh: Renovasi rumah" required></textarea>
                </div>

                {{-- Bunga (Hidden) --}}
                <input type="hidden" name="bunga" value="1.00">

                {{-- Submit --}}
                {{-- <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button> --}}

                {{-- <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pengajuan" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Pengajuan</label>
                    <input type="number" name="jumlah" required>
                </div>

                <div class="form-group">
                    <label>Tenor</label>
                    <input type="number" name="tenor" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="dicairkan">Dicairkan</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Slip Gaji</label>
                    <select name="slip_gaji_id" required>
                        @foreach ($slipGaji as $gaji)
                            <option value="{{ $gaji->id }}">{{ $gaji->nominal }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div style="text-align:center; margin-top:10px;">
                    <button type="submit" style="color:white; background:dodgerblue;">Simpan</button>
                    <button type="button" onclick="closeModal('addModal')"
                        style="color:white; background:darkgray;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editModal')">&times;</span>
            <h3>Ubah Pinjaman</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_pengajuan" id="editTanggal" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Bayar</label>
                    <input type="number" name="jumlah" id="editJumlah" required>
                </div>

                <div class="form-group">
                    <label>Tenor</label>
                    <input type="number" name="tenor" id="editKe" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="editStatus" required>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="dicairkan">Dicairkan</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>

                <div style="text-align:center; margin-top:10px;">
                    <button type="submit" style="color:white; background:orangered;">Update</button>
                    <button type="button" onclick="closeModal('editModal')"
                        style="color:white; background:darkgray;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('viewModal')">&times;</span>
            <h3>Detail Pinjaman</h3>
            <p><strong>Nama:</strong> <span id="viewNama"></span></p>
            <p><strong>Tanggal Pengajuan:</strong> <span id="viewTanggal"></span></p>
            <p><strong>Jumlah:</strong> Rp <span id="viewJumlah"></span></p>
            <p><strong>Tenor:</strong> <span id="viewTenor"></span></p>
            <p><strong>Bunga:</strong> <span id="viewBunga"></span></p>
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
    </style>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function editPinjaman(id) {
            fetch(`/data-pinjaman/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('editForm').action = `/data-pinjaman/${id}`;
                    document.getElementById('editTanggal').value = data.tanggal_pengajuan;
                    document.getElementById('editJumlah').value = data.jumlah;
                    document.getElementById('editKe').value = data.tenor;
                    document.getElementById('editStatus').value = data.status;
                    openModal('editModal');
                });
        }

        function viewDetail(id) {
            fetch(`/data-pinjaman/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('viewNama').textContent = data?.anggota?.username ?? 'N/A';
                    document.getElementById('viewTanggal').textContent = data.tanggal_pengajuan;
                    document.getElementById('viewJumlah').textContent = new Intl.NumberFormat('id-ID').format(data
                        .jumlah);
                    document.getElementById('viewTenor').textContent = data.tenor;
                    document.getElementById('viewBunga').textContent = data.bunga;
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
