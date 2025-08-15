<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-logo">
                <img src="/images/logo-koperasi.png" alt="Logo Koperasi">
            </div>
            <h2 class="login-title">Login Admin</h2>
            <p class="login-subtitle">Masukkan email dan password Anda</p>

            <form>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Masukkan email">
                </div>

                <div class="form-group password-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" placeholder="Masukkan password">
                        <i class="ph ph-eye toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="btn full-width">Login</button>
            </form>

            <div class="login-footer">
                &copy; 2025 Koperasi. All rights reserved.
            </div>
        </div>
    </div>


    <!-- Icon: gunakan Phosphor Icons (ph-eye, ph-eye-slash) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('ph-eye');
            eyeIcon.classList.add('ph-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('ph-eye-slash');
            eyeIcon.classList.add('ph-eye');
        }
    }
    </script>

</body>

</html>