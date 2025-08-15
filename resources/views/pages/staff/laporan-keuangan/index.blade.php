@extends('main')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="dashboard-header">
    <h3>Laporan Keuangan</h3>
</div>
<div class="table-wrapper">
    <div class="table-actions"
        style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <!-- Kiri: Tombol Tambah -->
        <div>
            <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button>
        </div>

        <!-- Kanan: Filter dan Cetak PDF -->
        <div style="display: flex; gap: 10px; align-items: center;">
            <select id="tanggalFilter" onchange="filterTanggal()" style="padding: 6px;">
                <option value="semua">Semua</option>
                <option value="hari">Hari Ini</option>
                <option value="bulan">Bulan Ini</option>
                <option value="tahun">Tahun Ini</option>
            </select>

            <button onclick="cetakTabelPDF()" style="padding: 6px 12px;">Cetak PDF</button>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th>Masuk (Rp)</th>
                <th>Keluar (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2025-07-06</td>
                <td>Simpanan Anggota</td>
                <td>Masuk</td>
                <td>1.000.000</td>
                <td>-</td>
                <td>5.000.000</td>
                <td>
                    <button onclick="openModal('viewModal')">Lihat</button>
                    <button onclick="confirm('Yakin ingin hapus data ini?')">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <span class="active">1</span>
        <span>2</span>
        <span>3</span>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h3>Tambah Laporan Keuangan</h3>
        <form>
            <label>Tanggal</label>
            <input type="date" />

            <label>Keterangan</label>
            <input type="text" placeholder="Contoh: Pembayaran listrik" />

            <label>Jenis Transaksi</label>
            <select style="width: 100%; padding: 8px; font-size: 14px; box-sizing: border-box;">
                <option value="Masuk">Masuk</option>
                <option value="Keluar">Keluar</option>
            </select>
            <label>Jumlah</label>
            <input type="number" placeholder="Masukkan jumlah (Rp)" />

            <div style="text-align: center;">
                <button type="submit" style="background: dodgerblue; color: white;">Simpan</button>
                <button type="button" onclick="closeModal('addModal')"
                    style="background: darkgray; color: white;">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Lihat -->
<div class="modal" id="viewModal">
    <div class="modal-content" id="laporanDetail">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h3>Detail Laporan Keuangan</h3>
        <p><strong>Tanggal:</strong> 2025-07-06</p>
        <p><strong>Keterangan:</strong> Simpanan Anggota</p>
        <p><strong>Jenis:</strong> Masuk</p>
        <p><strong>Jumlah:</strong> Rp 1.000.000</p>
        <p><strong>Saldo Saat Ini:</strong> Rp 5.000.000</p>
    </div>
</div>


<script>
function openModal(id) {
    document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach((modal) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
};

function cetakPDF() {
    const printContent = document.getElementById("laporanDetail").innerHTML;
    const printWindow = window.open('', '', 'height=700,width=700');
    printWindow.document.write('<html><head><title>Cetak Laporan</title>');
    printWindow.document.write(`
        <style>
          body { font-family: Arial, sans-serif; padding: 30px; }
          h3 { text-align: center; }
          p { font-size: 14px; line-height: 1.6; }
        </style>
      `);
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
@endsection