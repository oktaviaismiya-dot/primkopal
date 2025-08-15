@extends('main')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="dashboard-header">
    <h3>Manajemen Pengguna</h3>
</div>

<div class="table-wrapper">
    <div class="table-actions"
        style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <div>
            <button class="btn-add" onclick="openModal('addModal')">+ Tambah</button>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <select id="roleFilter" onchange="filterUser()" style="padding: 6px;">
                <option value="semua">Semua Role</option>
                @foreach($roles as $role)
                <option value="{{ strtolower($role->nama) }}">{{ ucfirst($role->nama) }}</option>
                @endforeach
            </select>

            <select id="statusFilter" onchange="filterUser()" style="padding: 6px;">
                <option value="semua">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Pangkat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ ucfirst($user->role->nama ?? '-') }}</td>
                <td>{{ $user->pangkat->nama ?? '-' }}</td>
                <td>
                    <button onclick="openModal('viewModal-{{ $user->id }}')">Lihat</button>
                    <form action="{{ route('manage-pengguna.destroy', $user->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin hapus user ini?')">Hapus</button>
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
        <h3>Tambah Pengguna</h3>
        <form action="{{ route('manage-pengguna.store') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required />

            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required />

            <label>Role</label>
            <select name="role_id" required>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ ucfirst($role->nama) }}</option>
                @endforeach
            </select>

            <label>Pangkat</label>
            <select name="pangkat_id" required>
                @foreach($pangkats as $pangkat)
                <option value="{{ $pangkat->id }}">{{ $pangkat->nama }}</option>
                @endforeach
            </select>

            <div style="text-align: center; margin-top: 10px;">
                <button type="submit" style="background: dodgerblue; color: white;">Simpan</button>
                <button type="button" onclick="closeModal('addModal')"
                    style="background: darkgray; color: white;">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail per User -->
@foreach($users as $user)
<div class="modal" id="viewModal-{{ $user->id }}">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal-{{ $user->id }}')">&times;</span>
        <h3>Detail Pengguna</h3>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role->nama ?? '-') }}</p>
        <p><strong>Pangkat:</strong> {{ $user->pangkat->nama ?? '-' }}</p>
    </div>
</div>
@endforeach



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

    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach((modal) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    };

    function filterUser() {
        const role = document.getElementById("roleFilter").value.toLowerCase();
        const status = document.getElementById("statusFilter").value.toLowerCase();
        const rows = document.querySelectorAll(".data-table tbody tr");

        rows.forEach(row => {
            const userRole = row.cells[3].textContent.toLowerCase();
            const userStatus = row.cells[4].textContent.toLowerCase();

            const roleMatch = role === "semua" || userRole === role;
            const statusMatch = status === "semua" || userStatus === status;

            row.style.display = roleMatch && statusMatch ? "" : "none";
        });
    }
</script>
@endsection