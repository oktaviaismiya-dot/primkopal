<header class="topbar" style="display: flex; justify-content: flex-end; align-items: center;">
    <div class="profile-container">
        <i class="ph ph-user-circle profile-icon" id="profileIcon"></i>
        <div class="dropdown-menu" id="dropdownMenu">
            {{-- <a href="/profile"><i class="ph ph-user"></i> Profile</a> --}}
            {{-- <a href="#"><i class="ph ph-sign-out"></i> Logout</a> --}}
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                <i class="ph ph-sign-out"></i> Logout
            </a>
        </div>
    </div>
</header>
