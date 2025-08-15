@extends('main')

@section('title', 'Dashboard Anggota')

@section('content')
    <h3>Selamat Datang, {{ Auth::user()->username }}</h3>

    <div class="cards">
        <div class="card">
            <div class="card-title">
                <i class="ph ph-file-text"></i>
                <p>Slip Gaji Terbaru</p>
            </div>
            <span>Belum Diupload</span>
            <small class="trend down">Diperlukan untuk pengajuan</small>
        </div>

        <div class="card">
            <div class="card-title">
                <i class="ph ph-file-plus"></i>
                <p>Form Pengajuan</p>
            </div>
            <span>Status: Belum Diajukan</span> <br>
            <small class="trend neutral">Isi form untuk memulai</small>
        </div>
    </div>

    {{-- <div class="card">
        <h3>Ajukan Pinjaman</h3>
        <p>Silakan upload slip gaji dan isi form pengajuan untuk memproses permintaan pinjaman.</p>

        <form action="" method="POST" enctype="multipart/form-data" class="form-pengajuan">

            <div class="form-group">
                <label for="slip_gaji">Upload Slip Gaji</label>
                <input type="file" name="slip_gaji" id="slip_gaji" required>
            </div>

            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman</label>
                <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" placeholder="Masukkan jumlah pinjaman"
                    required>
            </div>

            <div class="form-group">
                <label for="keperluan">Keperluan</label>
                <textarea name="keperluan" id="keperluan" placeholder="Tuliskan keperluan pinjaman" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Sekarang</button>
        </form>
    </div> --}}

    <style>
        .cards {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            flex: 1 1 250px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-pengajuan .form-group {
            margin-bottom: 16px;
        }

        .form-pengajuan input,
        .form-pengajuan textarea {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .form-pengajuan button {
            background-color: #2d6cdf;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
@endsection
