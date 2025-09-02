<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Koperasi')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>

<body>
    <div class="container">
        @include('partials.sidebar')
        <main class="main-content">
            @include('partials.header')
            <section class="dashboard">
                @yield('content')
            </section>
        </main>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                });
            @endif
        });
    </script>

    <script>
    const profileIcon = document.getElementById('profileIcon');
    const profileContainer = document.querySelector('.profile-container');

    profileIcon.addEventListener('click', () => {
        profileContainer.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!profileContainer.contains(e.target)) {
            profileContainer.classList.remove('active');
        }
    });
    </script>
</body>

</html>
