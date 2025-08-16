@extends('main')

@section('title', 'Data Simpanan')

@section('content')
    <div class="dashboard-header">
        <h3>Data Simpanan</h3>
    </div>

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <div class="table-actions">
            <form action="{{ route('data-simpanan.index') }}" method="GET"
                style="display: flex; gap: 10px; margin-bottom: 15px;">
                <div>
                    <label for="month">Filter Bulan:</label>
                    <select name="month" id="month" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="jenis_simpanan_id">Filter Jenis:</label>
                    <select name="jenis_simpanan_id" id="jenis_simpanan_id" onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        @foreach ($jenisSimpanans as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ request('jenis_simpanan_id') == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-top: 28px;">
                    <a href="{{ route('data-simpanan.index') }}" class="btn-reset" style="font-size: 0.8rem;">Reset Filter</a>
                </div>
            </form>
            <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($simpanans as $index => $simpanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $simpanan->user->username }}</td>
                        <td>{{ $simpanan->tanggal_formatted }}</td>
                        <td>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $simpanan->jenisSimpanan->nama }}</td>
                        <td>
                            <button onclick="openModal('viewModal{{ $simpanan->id }}')">Lihat</button>
                            <button onclick="openModal('editModal{{ $simpanan->id }}')">Ubah</button>
                            <form action="{{ route('data-simpanan.destroy', $simpanan->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Lihat -->
                    <div class="modal" id="viewModal{{ $simpanan->id }}">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('viewModal{{ $simpanan->id }}')">&times;</span>
                            <h3>Detail Simpanan</h3>
                            <p><strong>Nama:</strong> {{ $simpanan->user->username }}</p>
                            <p><strong>Tanggal:</strong> {{ $simpanan->tanggal }}</p>
                            <p><strong>Nominal:</strong> Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</p>
                            <p><strong>Keterangan:</strong> {{ $simpanan->jenisSimpanan->nama }}</p>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal" id="editModal{{ $simpanan->id }}">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('editModal{{ $simpanan->id }}')">&times;</span>
                            <h3>Ubah Simpanan</h3>
                            <form action="{{ route('data-simpanan.update', $simpanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div style="margin-bottom: 10px;">
                                    <label><strong>Nama</strong></label>
                                    <select name="user_id" required style="width: 100%;">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $simpanan->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <label><strong>Tanggal</strong></label>
                                    <input type="date" name="tanggal" value="{{ $simpanan->tanggal }}"
                                        style="width: 100%;" required>
                                </div>

                                <div style="margin-bottom: 10px;">
                                    <label><strong>Nominal</strong></label>
                                    <input type="number" name="jumlah" value="{{ $simpanan->jumlah }}"
                                        style="width: 100%;" required>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label><strong>Jenis Simpanan</strong></label>
                                    <select name="jenis_simpanan_id" required style="width: 100%;">
                                        @foreach ($jenisSimpanans as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ $jenis->id == $simpanan->jenis_simpanan_id ? 'selected' : '' }}>
                                                {{ $jenis->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div style="text-align:center;">
                                    <button type="submit"
                                        style="padding: 8px 20px; color: white; background-color: orangered; border: none;">Update</button>
                                    <button type="button" onclick="closeModal('editModal{{ $simpanan->id }}')"
                                        style="padding: 8px 20px; color: white; background-color: darkgray; border: none;">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addModal')">&times;</span>
            <h3>Tambah Simpanan</h3>
            <form action="{{ route('data-simpanan.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 10px;">
                    <label for="user_id"><strong>Nama</strong></label>
                    <select name="user_id" id="user_id" style="width: 100%;" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 10px;">
                    <label for="tanggal"><strong>Tanggal</strong></label>
                    <input type="date" name="tanggal" id="tanggal" style="width: 100%;" required>
                </div>

                <div style="margin-bottom: 10px;">
                    <label for="jumlah"><strong>Nominal</strong></label>
                    <input type="number" name="jumlah" id="jumlah" placeholder="Jumlah Simpanan" style="width: 100%;"
                        required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="jenis_simpanan_id"><strong>Jenis Simpanan</strong></label>
                    <select name="jenis_simpanan_id" id="jenis_simpanan_id" style="width: 100%;" required>
                        <option value="">-- Pilih Jenis Simpanan --</option>
                        @foreach ($jenisSimpanans as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="text-align:center;">
                    <button type="submit"
                        style="padding: 8px 20px; color: white; background-color: dodgerblue; border: none;">Simpan</button>
                    <button type="button" onclick="closeModal('addModal')"
                        style="padding: 8px 20px; color: white; background-color: darkgray; border: none;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .modal-content input,
        .modal-content select {
            padding: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modal-content label {
            display: block;
            margin-bottom: 4px;
        }

        .btn-reset {
            padding: 8px 15px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }

        .btn-reset:hover {
            background-color: #5a6268;
        }

        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .table-actions form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .table-actions select {
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
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
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
@endsection
