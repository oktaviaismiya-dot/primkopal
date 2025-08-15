@extends('main')

@section('title', 'Profil Admin')

@section('content')
 <h3 class="dashboard-heading">Profil Admin</h3>

<div class="profile-layout">
    {{-- KARTU PROFIL --}}
    <div class="card profile-card">
        <div class="profile-header">
            <i class="ph ph-user-circle icon-profile"></i>
            <h4 class="admin-name">Admin Koperasi</h4>
            <p class="admin-role">Super Admin</p>
        </div>

        <ul class="profile-info">
            <li><strong>Nama Lengkap:</strong> Budi Santoso</li>
            <li><strong>Email:</strong> admin@koperasi.com</li>
            <li><strong>Nomor HP:</strong> 0812-3456-7890</li>
            <li><strong>Terdaftar Sejak:</strong> Januari 2022</li>
        </ul>
    </div> 

    {{-- FORM UBAH DATA --}}
    <div class="card update-form-card">
        <h4>Perbarui Email & Password</h4>
        <form action="#" method="POST">
            {{-- @csrf jika backend aktif --}}
            <div class="form-group">
                <label for="email">Email Baru</label>
                <input type="email" id="email" name="email" placeholder="admin@koperasi.com">
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" placeholder="********">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<style>
.dashboard-heading {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.profile-layout {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    align-items: flex-start;
}

.profile-card,
.update-form-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    flex: 1 1 300px;
    min-width: 300px;
}

.profile-header {
    text-align: center;
    margin-bottom: 20px;
}

.icon-profile {
    font-size: 60px;
    color: #2d6cdf;
    margin-bottom: 10px;
}

.admin-name {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.admin-role {
    font-size: 14px;
    color: #777;
}

.profile-info {
    list-style: none;
    padding-left: 0;
    font-size: 14px;
    color: #444;
}

.profile-info li {
    margin-bottom: 10px;
}

.update-form-card form .form-group {
    margin-bottom: 16px;
}

.update-form-card label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #222;
}

.update-form-card input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
    background-color: #fff;
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
</style>
@endsection