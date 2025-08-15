@extends('main')

@section('title', 'Pengajuan Pinjaman Anggota')

@section('content')
<h3 class="dashboard-heading">Form Pengajuan Pinjaman</h3>

<div class="form-layout">
    {{-- FORM PENGAJUAN --}}
    <div class="card form-card">
        <p>Silakan isi form berikut dan unggah slip gaji Anda. Jumlah pinjaman dibatasi berdasarkan jabatan.</p>

        <form class="form-pengajuan" action="#" method="POST" enctype="multipart/form-data">
            {{-- @csrf jika backend aktif --}}

            {{-- Data Jabatan / Pangkat --}}
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

            {{-- Pilih Slip Gaji --}}
            <div class="form-group">
                <label for="slip_gaji_id">Pilih Slip Gaji</label>
                <select id="slip_gaji_id" name="slip_gaji_id" required>
                    <option value="" selected disabled>Pilih salah satu</option>
                    <option value="1">Juli 2025 - Rp 5.000.000</option>
                    <option value="2">Juni 2025 - Rp 4.800.000</option>
                    {{-- Ini nanti dinamis dari controller --}}
                </select>
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
                <textarea id="keperluan" name="keperluan" rows="4" placeholder="Contoh: Renovasi rumah"
                    required></textarea>
            </div>

            {{-- Bunga (Hidden) --}}
            <input type="hidden" name="bunga" value="1.00">

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button>
        </form>
    </div>

    {{-- INFO PENGAJU + INFORMASI PINJAMAN --}}
    <div class="card info-card">
        <h4>Informasi Pengguna</h4>
        <div class="profile">
            <i class="ph ph-user-circle icon-user"></i>
            <span class="user-name">Sertu Budi Santoso</span>
        </div>

        <ul class="info-list">
            <li><strong>NIK:</strong> 1234567890123456</li>
            <li><strong>Jabatan:</strong> Tamtama</li>
            <li><strong>Unit:</strong> Kodim 0501/Jakarta Pusat</li>
            <li><strong>Telp:</strong> 0812-3456-7890</li>
        </ul>

        <hr style="margin: 20px 0; border-color: #ddd;">

        <h4>Informasi Pinjaman</h4>
        <ul class="info-list">
            <li><strong>Bunga:</strong> 1% </li>
            <li><strong>Tenor:</strong> 12 atau 24 bulan</li>
            <li><strong>Maksimal Pinjaman:</strong>
                <ul>
                    <li>Tamtama: Rp10.000.000</li>
                    <li>Bintara: Rp15.000.000</li>
                    <li>Perwira: Rp20.000.000</li>
                    <li>Letkol: Rp25.000.000</li>
                </ul>
            </li>
            <li><strong>Slip Gaji:</strong> Wajib diunggah (PDF/JPG, maks 2MB)</li>
            <li><strong>Syarat:</strong> Pengajuan hanya bisa dilakukan 1x dalam 3 bulan</li>
        </ul>
    </div>
</div>

<style>
.dashboard-heading {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.form-layout {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 24px;
    align-items: flex-start;
}

.form-card,
.info-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    flex: 1 1 300px;
    min-width: 280px;
}

.form-pengajuan .form-group {
    margin-bottom: 16px;
}

.form-pengajuan label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #222;
}

.form-pengajuan input,
.form-pengajuan select,
.form-pengajuan textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    background-color: #fff;
}

.note {
    font-size: 12px;
    color: #888;
}

.btn-primary {
    background-color: #2d6cdf;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
}

.profile {
    display: flex;
    align-items: center;
    justify-content: center;
    /* Center horizontally */
    margin-bottom: 16px;
    text-align: center;
}

.icon-user {
    font-size: 36px;
    /* Lebih besar */
    color: #2d6cdf;
}


.user-name {
    font-size: 16px;
    margin-left: 10px;
    color: #222;
    font-weight: 600;
}

.info-list {
    list-style: none;
    padding-left: 0;
    font-size: 14px;
    color: #444;
}

.info-list li {
    margin-bottom: 10px;
}

.info-list ul {
    margin-top: 6px;
    margin-left: 16px;
    list-style-type: disc;
}
</style>
@endsection
