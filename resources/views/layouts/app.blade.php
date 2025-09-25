<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') | Tali Kuat Bina Marga</title>


    <!-- Material Design Icons -->
<link href="https://cdn.materialdesignicons.com/6.6.96/css/materialdesignicons.min.css" rel="stylesheet">

    {{-- icon logo --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/talikuat.png') }}" type="image/x-icon">

    {{-- link css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com"/>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet"/>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- chartJs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b9e0244bcc.js" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css"/>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    transition: width 0.3s ease;
}



        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar-header {
            padding: 20px 10px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }
        .sidebar-header img {
    max-height: 80px;
    transition: all 0.35s ease;
    filter: drop-shadow(0 2px 6px rgba(0,0,0,0.3));
}

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }
        .sidebar .nav-link {
            color: #374151;
            font-weight: 500;
            border-radius: 10px;
            margin: 4px 0;
            padding: 10px 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
            font-size: 18px;
            flex-shrink: 0;
        }
        .sidebar .nav-link:hover {
            background-color: #eaf3ff;
            color: #0d6efd;
            font-weight: 600;
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff !important;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(37,99,235,0.3);
        }
        .sidebar .collapse .nav-link {
            font-size: 14px;
            padding-left: 32px;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed h5 {
            display: none;
        }
        .sidebar.collapsed .nav-link {
            justify-content: center;
        }
        .sidebar.collapsed .sidebar-header img {
            max-height: 40px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 80px;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link,
        .navbar-custom .navbar-text {
        color: #fff;
        }
        .navbar-toggler {
            border: none;
            font-size: 1.5rem;
            color: #fff;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .alert {
            border-radius: 10px;
        }


        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }

        .bx-chevron-down {
    transition: transform 0.3s ease;
}
.rotate-180 {
    transform: rotate(180deg);
}

.sidebar.collapsed .nav-link span,
.sidebar.collapsed .nav-link .bx-chevron-down {
    display: none !important;
}

.sidebar.collapsed .nav-link {
    justify-content: center;
}

.sidebar.collapsed .ps-4 {
    display: none !important;
}


    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('links')
</head>

<body>
   <!-- Sidebar -->
<div id="sidebar" 
     class="sidebar bg-light border-end h-100"
     x-data="{ openMenu: null, collapsed: false }">

    <!-- Header -->
    <div class="sidebar-header text-center p-3 border-bottom">
        <img src="{{ asset('assets/images/talikuat.png') }}" alt="Logo" class="img-fluid" style="max-height:70px;">
    </div>

    <!-- Menu -->
    <div class="sidebar-menu p-2">
        <nav class="nav flex-column">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('dashboard') ? 'active fw-bold' : '' }}"
               data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                <i class="bx bx-grid-alt me-2"></i>
                <span class="menu-text">Dashboard</span>
            </a>

            <!-- Manajemen User -->
            @if (Auth::check() && in_array(Auth::user()->userDetail->role, [1,2]))
            <a href="{{ route('user-manajement.index') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('user-manajement*') ? 'active fw-bold' : '' }}"
               data-bs-toggle="tooltip" title="Manajemen User">
                <i class="bx bx-user me-2"></i>
                <span class="menu-text">Manajemen User</span>
            </a>
            @endif

            <!-- Master Data -->
            @if (Auth::user()->userDetail->role != 7)
            <a href="javascript:void(0)" 
               class="nav-link d-flex justify-content-between align-items-center"
               @click="openMenu === 1 ? openMenu = null : openMenu = 1"
               data-bs-toggle="tooltip" title="Master Data">
                <div class="d-flex align-items-center">
                    <i class="bx bx-data me-2"></i>
                    <span class="menu-text">Master Data</span>
                </div>
                <i class="bx bx-chevron-down" :class="openMenu === 1 ? 'rotate-180' : ''"></i>
            </a>
            <div class="ps-4" x-show="openMenu === 1" x-collapse>
                <a href="{{ route('data-utama.index','nmp')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('data-utama/nmp*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Data Jenis Pekerjaan</span>
                </a>
                <a href="{{ route('data-utama.index','kontraktor') }}" 
                   class="nav-link d-flex align-items-center {{ request()->is('data-utama/kontraktor*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Data Kontraktor</span>
                </a>
                <a href="{{ route('data-utama.index','konsultan') }}" 
                   class="nav-link d-flex align-items-center {{ request()->is('data-utama/konsultan*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Data Konsultan</span>
                </a>
                <a href="{{ route('admin.category.index') }}" 
                   class="nav-link d-flex align-items-center {{ request()->is('admin/category*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Kategori Dokumen</span>
                </a>
            </div>
            @endif

            <!-- Data Umum -->
            <a href="{{ route('data-umum.index', date('Y')) }}" 
               class="nav-link d-flex align-items-center {{ request()->is('data-umum*') ? 'active fw-bold' : '' }}"
               data-bs-toggle="tooltip" title="Data Umum">
                <i class="bx bx-file me-2"></i>
                <span class="menu-text">Data Umum</span>
            </a>

            <!-- Jadwal -->
            <a href="{{ route('jadual.index') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('jadual*') ? 'active fw-bold' : '' }}"
               data-bs-toggle="tooltip" title="Jadwal">
                <i class="bx bxs-spreadsheet me-2"></i>
                <span class="menu-text">Jadwal</span>
            </a>

            <!-- Laporan -->
            @if (in_array(Auth::user()->userDetail->role, [1,2,5,6,4,7]))
            <a href="javascript:void(0)" 
               class="nav-link d-flex justify-content-between align-items-center"
               @click="openMenu === 2 ? openMenu = null : openMenu = 2"
               data-bs-toggle="tooltip" title="Laporan">
                <div class="d-flex align-items-center">
                    <i class="bx bxs-report me-2"></i>
                    <span class="menu-text">Laporan</span>
                </div>
                <i class="bx bx-chevron-down" :class="openMenu === 2 ? 'rotate-180' : ''"></i>
            </a>
            <div class="ps-4" x-show="openMenu === 2" x-collapse>
                @if (in_array(Auth::user()->userDetail->role, [1,2,5,6]))
                <a href="{{route('laporan-mingguan-uptd.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('laporan-mingguan-uptd*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Mingguan UPTD</span>
                </a>
                <a href="{{route('laporan-bulanan-uptd.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('laporan-bulanan-uptd*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Bulanan UPTD</span>
                </a>
                <a href="{{route('laporan-keuangan.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('laporan-keuangan*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Keuangan</span>
                </a>
                @endif

                @if (in_array(Auth::user()->userDetail->role, [1,4]))
                <a href="{{route('laporan-mingguan-konsultan.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('laporan-mingguan-konsultan*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Mingguan Konsultan</span>
                </a>
                <a href="{{route('laporan-bulanan-konsultan.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('laporan-bulanan-konsultan*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Bulanan Konsultan</span>
                </a>
                @endif

                @if (in_array(Auth::user()->userDetail->role, [1,7]))
                <a href="{{route('progress-fisik.index')}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('progress-fisik*') ? 'active fw-bold' : '' }}">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Laporan Progress</span>
                </a>
                @endif
            </div>
            @endif

            <!-- Rekap -->
            @if (Auth::user()->userDetail->role == 1)
            <a href="javascript:void(0)" 
               class="nav-link d-flex justify-content-between align-items-center"
               @click="openMenu === 3 ? openMenu = null : openMenu = 3"
               data-bs-toggle="tooltip" title="Rekap Laporan">
                <div class="d-flex align-items-center">
                    <i class="bx bx-book me-2"></i>
                    <span class="menu-text">Rekap Laporan</span>
                </div>
                <i class="bx bx-chevron-down" :class="openMenu === 3 ? 'rotate-180' : ''"></i>
            </a>
            <div class="ps-4" x-show="openMenu === 3" x-collapse>
                @for ($i = 1; $i <= 6; $i++)
                <a href="{{route('rekap-dokumen.index',$i)}}" 
                   class="nav-link d-flex align-items-center {{ request()->is('rekap-dokumen/'.$i) ? 'active fw-bold' : '' }}" target="_blank">
                   <i class="bx bx-circle me-2"></i>
                   <span class="menu-text">Rekap Dokumen UPTD {{$i}}</span>
                </a>
                @endfor
            </div>
            @endif

            <hr>

            <!-- Logout -->
            <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center text-danger fw-bold"
               data-bs-toggle="tooltip" title="Logout">
                <i class="bx bx-log-out me-2"></i>
                <span class="menu-text">Logout</span>
            </a>
        </nav>
    </div>
</div>

    <!-- Main content -->
    <div class="main-content" id="mainContent">
        <nav class="navbar navbar-expand-lg navbar-custom rounded-3 mb-4 px-4">
            <div class="container-fluid">
                <button class="navbar-toggler me-3" type="button" id="toggleSidebar">
                    <i class="bx bx-menu"></i>
                </button>
                <span class="navbar-text">
                    Selamat Datang, <strong>{{ Auth::user()->name ?? Auth::guard('external')->user()->name }}</strong>
                </span>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/talikuat.png') }}" class="rounded-circle ms-3" width="40" height="40" alt="User">
                </div>
            </div>
        </nav>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">{{ $message }}</div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(function(){
            $(".alert").delay(3000).fadeOut(500);
            $('[data-bs-toggle="tooltip"]').tooltip();

            $('#sidebar .collapse').on('show.bs.collapse', function () {
                $(this).prev('[data-bs-toggle="collapse"]').find('.bx-chevron-down').addClass('rotate');
            });

            $('#sidebar .collapse').on('hide.bs.collapse', function () {
                $(this).prev('[data-bs-toggle="collapse"]').find('.bx-chevron-down').removeClass('rotate');
            });


            $('#toggleSidebar').on('click', function () {
                $('#sidebar').toggleClass('collapsed');
                $('#mainContent').toggleClass('expanded');
            });
        });
    </script>

    @yield('scripts')
</body>
</html>