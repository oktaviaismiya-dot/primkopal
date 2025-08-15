@extends('main')

@section('title', 'Data Anggota')

@section('content')
<div class="dashboard-header">
    <h3>Data Anggota</h3>
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
                <th>Pangkat</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $index => $a)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $a->username }}</td>
                <td>{{ $a->pangkat->nama }}</td>
                <td>{{ $a->role->nama }}</td>
                <td>
                    <button onclick="showDetail({{ $a->id }})">Lihat</button>
                    <button onclick="editAnggota({{ $a->id }})">Ubah</button>
                    <form action="{{ route('data-anggota.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                    </form>
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
        <h3>Tambah Anggota</h3>
        <form action="{{ route('data-anggota.store') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Role</label>
            <select name="role_id" required>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->nama }}</option>
                @endforeach
            </select>

            <label>Pangkat</label>
            <select name="pangkat_id" required>
                @foreach ($pangkats as $pangkat)
                <option value="{{ $pangkat->id }}">{{ $pangkat->nama }}</option>
                @endforeach
            </select>

            <div style="text-align:center;">
                <button type="submit" class="btn-save" style="color:white; background: dodgerblue;">Simpan</button>
                <button type="button" class="btn-cancel" style="color:white; background: darkgray;"
                    onclick="closeModal('addModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Lihat -->
<div class="modal" id="viewModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h3>Detail Anggota</h3>
        <div class="detail-body"></div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h3>Ubah Data Anggota</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password">

            <label>Role</label>
            <select name="role_id" required>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->nama }}</option>
                @endforeach
            </select>

            <label>Pangkat</label>
            <select name="pangkat_id" required>
                @foreach ($pangkats as $pangkat)
                <option value="{{ $pangkat->id }}">{{ $pangkat->nama }}</option>
                @endforeach
            </select>

            <div style="text-align:center;">
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

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}

function showDetail(id) {
    fetch(`/data-anggota/${id}`)
        .then(res => res.json())
        .then(data => {
            document.querySelector('#viewModal .detail-body').innerHTML = `
                <p><strong>Username:</strong> ${data.username}</p>
                <p><strong>Role:</strong> ${data.role.nama}</p>
                <p><strong>Pangkat:</strong> ${data.pangkat.nama}</p>
            `;
            openModal('viewModal');
        });
}

function editAnggota(id) {
    fetch(`/data-anggota/${id}`)
        .then(res => res.json())
        .then(data => {
            const form = document.getElementById('editForm');
            form.action = `/data-anggota/${id}`;
            form.querySelector('input[name="username"]').value = data.username;
            form.querySelector('select[name="role_id"]').value = data.role_id;
            form.querySelector('select[name="pangkat_id"]').value = data.pangkat_id;
            form.querySelector('input[name="password"]').value = ''; // kosongkan password
            openModal('editModal');
        });
}
</script>
@endsection
