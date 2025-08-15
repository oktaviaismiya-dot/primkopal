@auth
    @php
        $user = auth()->user();
    @endphp
@endauth
<aside class="sidebar">
    <h2 class="logo">
        <img src="{{ asset('images/logo-ksp.png') }}" alt="Logo" class="logo-img">
        Koperasi Lanal Banyuwangi
    </h2>
    <div class="sidebar-user">
        <div class="user-icon-circle">
            <i class="ph ph-user"></i>
        </div>
        <div class="user-info">
            <span class="username">{{ Auth::user()->role->nama }}</span>
            <span class="status">
                <span class="status-indicator"></span> Online
            </span>
        </div>
    </div>

    <nav>
        <ul>
            @if ($user->role->nama === 'staff')
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard"><i class="ph ph-house"></i> Dashboard</a>
                </li>
                <li class="{{ request()->is('anggota') ? 'active' : '' }}">
                    <a href="/data-anggota"><i class="ph ph-users"></i> Data Anggota</a>
                </li>
                <li class="{{ request()->is('simpanan') ? 'active' : '' }}">
                    <a href="/data-simpanan"><i class="ph ph-bank"></i> Data Simpanan</a>
                </li>
                <li class="{{ request()->is('pinjaman') ? 'active' : '' }}">
                    <a href="/data-pinjaman"><i class="ph ph-wallet"></i> Data Pinjaman</a>
                </li>
                <li class="{{ request()->is('angsuran') ? 'active' : '' }}">
                    <a href="/data-angsuran"><i class="ph ph-credit-card"></i> Data Angsuran</a>
                </li>
                {{-- <li class="{{ request()->is('pangkat') ? 'active' : '' }}">
                    <a href="/pangkat-pinjaman"><i class="ph ph-star"></i> Pangkat & Pinjaman</a>
                </li> --}}
            @elseif ($user->role->nama === 'kepala koperasi')
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard-kepala"><i class="ph ph-house"></i> Dashboard Kepala Koperasi</a>
                </li>
                <li class="{{ request()->is('simpanan') ? 'active' : '' }}">
                    <a href="/data-simpanan"><i class="ph ph-bank"></i> Data Simpanan</a>
                </li>
                <li class="{{ request()->is('pinjaman') ? 'active' : '' }}">
                    <a href="/data-pinjaman-kop"><i class="ph ph-wallet"></i> Data Pinjaman</a>
                </li>
                <li class="{{ request()->is('angsuran') ? 'active' : '' }}">
                    <a href="/data-angsuran-kop"><i class="ph ph-credit-card"></i> Data Angsuran</a>
                </li>
            @elseif ($user->role->nama === 'anggota')
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard-anggota"><i class="ph ph-house"></i> Dashboard Anggota</a>
                </li>
                <li class="{{ request()->is('pinjaman') ? 'active' : '' }}">
                    <a href="/pinjaman-anggota"><i class="ph ph-wallet"></i> Data Pinjaman</a>
                </li>
                <li class="{{ request()->is('angsuran') ? 'active' : '' }}">
                    <a href="/angsuran-anggota"><i class="ph ph-credit-card"></i> Data Angsuran</a>
                </li>
                <li class="{{ request()->is('pengajuan') ? 'active' : '' }}">
                    <a href="/form-pengajuan"><i class="ph ph-file-plus"></i> Form Pengajuan</a>
                </li>
            @endif
            {{-- <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard"><i class="ph ph-house"></i> Dashboard</a>
            </li>
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard-anggota"><i class="ph ph-house"></i> Dashboard Anggota</a>
            </li>
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard-kepala"><i class="ph ph-house"></i> Dashboard Kepala Koperasi</a>
            </li>
            <li class="{{ request()->is('anggota') ? 'active' : '' }}">
                <a href="/data-anggota"><i class="ph ph-users"></i> Data Anggota</a>
            </li>
            <li class="{{ request()->is('simpanan') ? 'active' : '' }}">
                <a href="/data-simpanan"><i class="ph ph-bank"></i> Data Simpanan</a>
            </li>
            <li class="{{ request()->is('pinjaman') ? 'active' : '' }}">
                <a href="/data-pinjaman"><i class="ph ph-wallet"></i> Data Pinjaman</a>
            </li>
            <li class="{{ request()->is('angsuran') ? 'active' : '' }}">
                <a href="/data-angsuran"><i class="ph ph-credit-card"></i> Data Angsuran</a>
            </li>
            <li class="{{ request()->is('laporan') ? 'active' : '' }}">
                <a href="/laporan-keuangan"><i class="ph ph-file-text"></i> Laporan Keuangan</a>
            </li>
            <li class="{{ request()->is('users') ? 'active' : '' }}">
                <a href="/manage-pengguna"><i class="ph ph-gear"></i> Manage Pengguna</a>
            </li>
            <li class="{{ request()->is('pengajuan') ? 'active' : '' }}">
                <a href="/form-pengajuan"><i class="ph ph-file-plus"></i> Form Pengajuan</a>
            </li>
            <li class="{{ request()->is('slip-gaji') ? 'active' : '' }}">
                <a href="/slip-gaji"><i class="ph ph-paperclip"></i> Slip Gaji</a>
            </li>
            <li class="{{ request()->is('pangkat') ? 'active' : '' }}">
                <a href="/pangkat-pinjaman"><i class="ph ph-star"></i> Pangkat & Pinjaman</a>
            </li> --}}
        </ul>
    </nav>
</aside>

<style>
    /* Hilangkan garis bawah dan ubah warna ikon dan teks menjadi hitam */
    .sidebar nav ul li a {
        text-decoration: none;
        color: black;
        display: flex;
        align-items: center;
        gap: 8px;
        /* beri jarak antara ikon dan teks */
    }

    /* Pastikan hover tidak mengubah warna ke biru */
    .sidebar nav ul li a:hover {
        text-decoration: none;
        color: black;
    }

    /* Jika icon menggunakan font seperti "ph ph-house", atur juga warnanya */
    .sidebar nav ul li a i {
        color: black;
    }
</style>
