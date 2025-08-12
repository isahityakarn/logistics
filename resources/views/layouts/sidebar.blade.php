<nav class="sidebar-nav">
    <ul class="nav flex-column">


        @if (Auth::user()->user_type === 'admin')
          <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-truck"></i>
                    Admin Panel
                </a>
            </li>

        @elseif(Auth::user()->user_type === 'company')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}"
                    href="{{ route('company.dashboard') }}">
                    <i class="bi bi-building"></i>
                    Company Panel
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('loads.index') ? 'active' : '' }}"
                    href="{{ route('loads.index') }}">
                    <i class="bi bi-shield-check"></i>
                    Load
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('loads.index') ? 'active' : '' }}"
                    href="{{ route('bids.index') }}">
                    <i class="bi bi-shield-check"></i>
                    Bids
                </a>
            </li> --}}
        @elseif(Auth::user()->user_type === 'driver')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('driver.dashboard') ? 'active' : '' }}"
                    href="{{ route('driver.dashboard') }}">
                    <i class="bi bi-truck"></i>
                    Driver Panel
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('loads.index') ? 'active' : '' }}"
                    href="{{ route('loads.index') }}">
                    <i class="bi bi-shield-check"></i>
                    Load
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('loads.index') ? 'active' : '' }}"
                    href="{{ route('bids.index') }}">
                    <i class="bi bi-shield-check"></i>
                    Bids
                </a>
            </li> --}}
        @endif
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('loads.index') ? 'active' : '' }}"
                href="{{ route('loads.index') }}">
                <i class="bi bi-shield-check"></i>
                Load
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('loadsmy') ? 'active' : '' }}"
                href="{{ route('loadsmy') }}">
                <i class="bi bi-shield-check"></i>
                My Loads
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('bids.index') ? 'active' : '' }}"
                href="{{ route('bids.index') }}">
                <i class="bi bi-shield-check"></i>
                Bids
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.users.byType') ? 'active' : '' }}"
                href="{{ route('admin.users.byType') }}">
                <i class="bi bi-people"></i>
                Directory 
            </a>
        </li>

           <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('map.pickup') ? 'active' : '' }}"
                href="{{ route('map.pickup') }}">
                <i class="bi bi-people"></i>
                MAP 
            </a>
        </li>


        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
