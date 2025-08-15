@extends('main')

@section('title', 'Pangkat & Maksimal Pinjaman')

@section('content')
<div class="dashboard-header">
   {{-- <h3>Pangkat & Maksimal Pinjaman</h3>
</div>

<div class="table-wrapper">
    <div class="table-actions">
        <button class="btn-add" onclick="openModal('addModal')">+ Tambah Pangkat</button>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Pangkat</th>
                <th>Maksimal Pinjaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="rankTableBody">
            <tr>
                <td>1</td>
                <td>Tamtama</td>
                <td>Rp 10.000.000</td>
                <td>
                    <button onclick="openEditModal('Tamtama', 10000000)">Ubah</button>
                    <button onclick="confirm('Yakin ingin menghapus pangkat ini?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Bintara</td>
                <td>Rp 15.000.000</td>
                <td>
                    <button onclick="openEditModal('Bintara', 15000000)">Ubah</button>
                    <button onclick="confirm('Yakin ingin menghapus pangkat ini?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Perwira</td>
                <td>Rp 20.000.000</td>
                <td>
                    <button onclick="openEditModal('Perwira', 20000000)">Ubah</button>
                    <button onclick="confirm('Yakin ingin menghapus pangkat ini?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Letkol</td>
                <td>Rp 25.000.000</td>
                <td>
                    <button onclick="openEditModal('Letkol', 25000000)">Ubah</button>
                    <button onclick="confirm('Yakin ingin menghapus pangkat ini?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Pembantu Letnan Satu</td>
                <td>Rp 35.000.000</td>
                <td>
                    <button onclick="openEditModal('Pembantu Letnan Satu', 35000000)">Ubah</button>
                    <button onclick="confirm('Yakin ingin menghapus pangkat ini?')">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h3>Tambah Pangkat</h3>
        <form onsubmit="event.preventDefault(); alert('Data pangkat berhasil ditambahkan!'); closeModal('addModal');">
            <label>Nama Pangkat</label>
            <input type="text" placeholder="Contoh: Kapten" required>

            <label>Maksimal Pinjaman</label>
            <input type="number" placeholder="Contoh: 25000000" required>

            <div style="text-align:center; margin-top:10px;">
                <button type="submit" style="color:white; background: dodgerblue;">Simpan</button>
                <button type="button" style="color:white; background: darkgray;"
                    onclick="closeModal('addModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h3>Ubah Pangkat</h3>
        <form onsubmit="event.preventDefault(); alert('Data pangkat berhasil diubah!'); closeModal('editModal');">
            <label>Nama Pangkat</label>
            <input type="text" id="editPangkat" required>

            <label>Maksimal Pinjaman</label>
            <input type="number" id="editPinjaman" required>

            <div style="text-align:center; margin-top:10px;">
                <button type="submit" style="color:white; background: orangered;">Update</button>
                <button type="button" style="color:white; background: darkgray;"
                    onclick="closeModal('editModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'block';
  }

  function closeModal(id) {
    document.getElementById(id).style.display = 'none';
  }

  function openEditModal(pangkat, pinjaman) {
    document.getElementById('editPangkat').value = pangkat;
    document.getElementById('editPinjaman').value = pinjaman;
    openModal('editModal');
  }

  // Tutup modal jika klik di luar
  window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  };
</script> --}}
@endsection
