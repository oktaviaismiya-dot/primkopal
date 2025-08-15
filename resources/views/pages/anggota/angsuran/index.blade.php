@extends('main')

@section('title', 'Data Angsuran')

@section('content')

    <div class="dashboard-header">
        <h3>Data Angsuran</h3>
    </div>

    <div class="table-wrapper">
        <div class="table-actions">
            {{-- <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button> --}}
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
                @forelse ($angsurans as $index => $angsuran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $angsuran->formulirPengajuan->user->username ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($angsuran->tanggal)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $angsuran->angsuran_ke }}</td>
                        <td>Rp {{ number_format($angsuran->sisa_pembayaran ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('angsuran.anggota.cetak.faktur', $angsuran->id) }}" target="_blank" class="btn-cetak">
                                Cetak Faktur
                            </a>
                        </td>
                        {{-- <td>
                        <button onclick="editAngsuran({{ $angsuran->id }})">Ubah</button>
                        <form action="{{ route('angsuran.anggota.destroy', $angsuran->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                        </form>
                    </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada angsuran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addModal')">&times;</span>
            <h3>Tambah Angsuran</h3>
            <form action="{{ route('angsuran.anggota.store') }}" method="POST">
                @csrf

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

    <!-- Modal Edit -->
    {{-- <div class="modal" id="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h3>Edit Angsuran</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <label>Tanggal Bayar</label>
            <input type="date" name="tanggal" id="editTanggal" required>

            <label>Jumlah Angsuran</label>
            <input type="number" name="jumlah_bayar" id="editJumlah" required>

            <label>Angsuran Ke-</label>
            <input type="number" name="angsuran_ke" id="editAngsuranKe" required>

            <div style="text-align:center; margin-top:10px;">
                <button type="submit" style="color:white; background:dodgerblue;">Simpan</button>
                <button type="button" onclick="closeModal('editModal')"
                    style="color:white; background:darkgray;">Batal</button>
            </div>
        </form>
    </div>
</div> --}}

    <style>
        .btn-cetak {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-cetak:hover {
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

        // function editAngsuran(id) {
        //     fetch(`/angsuran/${id}/edit`)
        //         .then(response => response.json())
        //         .then(data => {
        //             document.getElementById('editTanggal').value = data.tanggal;
        //             document.getElementById('editJumlah').value = data.jumlah_bayar;
        //             document.getElementById('editAngsuranKe').value = data.angsuran_ke;
        //             document.getElementById('editForm').action = `/angsuran/${id}`;
        //             openModal('editModal');
        //         });
        // }

        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) modal.style.display = "none";
            });
        };
    </script>
@endsection
