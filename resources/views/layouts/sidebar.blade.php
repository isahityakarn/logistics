 <nav class="sidebar-nav">
     <ul class="nav flex-column">
         {{-- <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                 <i class="bi bi-speedometer2"></i>
                 Dashboard
             </a>
         </li> --}}

         @if (Auth::user()->user_type === 'admin')
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                     href="{{ route('admin.dashboard') }}">
                     <i class="bi bi-shield-check"></i>
                     Admin Panel
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.logistics-loads.*') ? 'active' : '' }}"
                     href="{{ route('admin.logistics-loads.index') }}">
                     <i class="bi bi-truck"></i>
                     Logistics Loads
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#">
                     <i class="bi bi-people"></i>
                     Manage Users
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.companies') ? 'active' : '' }}"
                     href="{{ route('admin.companies') }}">
                     <i class="bi bi-building"></i>
                     Companies
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.drivers') ? 'active' : '' }}"
                     href="{{ route('admin.drivers') }}">
                     <i class="bi bi-truck"></i>
                     Drivers
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
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('company.logistics-loads.*') ? 'active' : '' }}"
                     href="{{ route('company.logistics-loads.index') }}">
                     <i class="bi bi-box-seam"></i>
                      Loads
                 </a>
             </li>
          
         @elseif(Auth::user()->user_type === 'driver')
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('driver.dashboard') ? 'active' : '' }}"
                     href="{{ route('driver.dashboard') }}">
                     <i class="bi bi-truck"></i>
                     Driver Panel
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('driver.logistics-loads.*') ? 'active' : '' }}"
                     href="{{ route('driver.logistics-loads.index') }}">
                     <i class="bi bi-search"></i>
                     My Loads
                 </a>
             </li>
      
          
             <li class="nav-item">
                 <a class="nav-link" href="#">
                     <i class="bi bi-clock-history"></i>
                     Job History
                 </a>
             </li>
         @endif

         <li class="nav-item">
             <a class="nav-link" href="{{ route('logistics-job-prices.index') }}">
                 <i class="bi bi-person"></i>
                 Job Prices
             </a>
         </li>
         {{-- <li class="nav-item">
             <a class="nav-link" href="#">
                 <i class="bi bi-person"></i>
                 Profile
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="#">
                 <i class="bi bi-gear"></i>
                 Settings
             </a>
         </li> --}}
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
