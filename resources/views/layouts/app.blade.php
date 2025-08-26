<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title') | Tali Kuat Bina Marga</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bug.css') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <script src="https://kit.fontawesome.com/b9e0244bcc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class="bx bx-menu" id="header-toggle"></i>
        </div>
        <h3 class="text-center text-white">Selamat Datang, {{ Auth::user()->name ??
            Auth::guard('external')->user()->name }}</h3>
        <div class="header_img">
            <img src="{{ asset('assets/images/talikuat.png') }}" alt="" />
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div class="nav_logo">
                <img src="{{ asset('assets/images/talikuat.png') }}" alt="Tali Kuat Bina Marga" height="80" />
            </div>


            @if(!Auth::guard('external')->check())
            <div class="nav_list">
                <a href="{{ route('dashboard') }}" class="nav_link">
                    <i class="bx bx-grid-alt nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
                @if (Auth::user()->userDetail->role == 2 ||Auth::user()->userDetail->role == 1)
                <a href="{{ route('user-manajement.index') }}" class="nav_link">
                    <i class="bx bx-user nav_icon"></i>
                    <span class="nav_name">Manajemen User</span>
                </a>
                @endif
                @if (Auth::user()->userDetail->role != 7)
                <a class="nav_link" id="masterDataLink">
                    <i class="bx bx-data nav_icon"></i>
                    <span class="nav_name">Master Data <i id="dropdownIconMaster" class="bx "></i></span>
                </a>
                <div id="masterDataDropdown" class="nav_dropdown" style="display: none;">
                    <a href="{{ route('data-utama.index','nmp')}}" class="nav_link"><i class="bx bx-circle"></i>Data
                        Jenis Pekerjaan</a>
                    <a href="{{ route('data-utama.index','kontraktor') }}" class="nav_link"><i
                            class="bx bx-circle"></i>Data
                        kontraktor</a>
                    <a href="{{ route('data-utama.index','konsultan') }}" class="nav_link"><i
                            class="bx bx-circle"></i>Data Konsultan</a>
                    <a href="{{ route('admin.category.index') }}" class="nav_link"><i
                            class="bx bx-circle"></i>Kategori Dokumen</a>
                </div>
                @endif
                <a href="{{ route('data-umum.index',date('Y')) }}" class="nav_link">
                    <i class='bx bx-file nav_icon'></i>
                    <span class="nav_name">Data Umum</span>
                </a>
                <a href="{{route('jadual.index')}}" class="nav_link">
                    <i class="bx bxs-spreadsheet nav_icon"></i>
                    <span class="nav_name">Jadual</span>
                </a>
                @if (Auth::user()->userDetail->role == 2 ||Auth::user()->userDetail->role == 1
                ||Auth::user()->userDetail->role == 6 ||Auth::user()->userDetail->role == 5)
                <a class="nav_link" id="laporanLink">
                    <i class='bx bxs-report nav_icon'></i>
                    <span class="nav_name">Laporan <i id="dropdownIconLaporan" class="bx "></span>
                </a>
                <div id="laporanDropdown" class="nav_dropdown" style="display: none;">
                    <a href="{{route('laporan-mingguan-uptd.index')}}" class="nav_link">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Laporan Mingguan UPTD</span>
                    </a>
                    <a href="{{route('laporan-bulanan-uptd.index')}}" class="nav_link">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Laporan Bulanan UPTD</span>
                    </a>
                    <a href="{{route('laporan-keuangan.index')}}" class="nav_link">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Laporan keuangan</span>
                    </a>
                    @endif
                    @if (Auth::user()->userDetail->role == 4 ||Auth::user()->userDetail->role == 1)
                    <a href="{{route('laporan-mingguan-konsultan.index')}}" class="nav_link">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Laporan Mingguan Konsultan</span>
                    </a>
                    <a href="{{route('laporan-bulanan-konsultan.index')}}" class="nav_link">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Laporan Bulanan Konsultan</span>
                    </a>
                    @endif
                    @if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 7)
                    <a href="{{route('progress-fisik.index')}}" class="nav_link">
                        <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                        <span class="nav_name">Laporan Progress</span>
                    </a>
                    @endif
                </div>
                @if (Auth::user()->userDetail->role == 1)
                <a class="nav_link" id="rekapLink">
                    <i class='bx bxs-report nav_icon'></i>
                    <span class="nav_name">Rekap Laporan<i id="dropdownIconRekap" class="bx "></span>
                </a>
                <div id="rekapDropdown" class="nav_dropdown" style="display: none;">
                    @for ($i = 1; $i <= 6; $i++) <a href="{{route('rekap-dokumen.index',$i)}}" class="nav_link"
                        target="_blank">
                        <i class='bx bxs-report nav_icon'></i>
                        <span class="nav_name">Rekap Dukomen UPTD {{$i}}</span>
                        </a>
                        @endfor
                </div>
                @endif
            </div>
            @endif
            @if(Auth::guard('external')->check())
            <div>
                <a href="{{ route('dashboard-external') }}" class="nav_link">
                    <i class="bx bx-grid-alt nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>

                @if (Auth::guard('external')->user()->role == 4)
                <a href="{{route('laporan-mingguan-konsultan-external.index')}}" class="nav_link">
                    <i class='bx bxs-report nav_icon'></i>
                    <span class="nav_name">Laporan Mingguan Konsultan</span>
                </a>
                <a href="{{route('laporan-bulanan-konsultan-external.index')}}" class="nav_link">
                    <i class='bx bxs-report nav_icon'></i>
                    <span class="nav_name">Laporan Bulanan Konsultan</span>
                </a>
            </div>

            @endif

            @endif

            <button class="nav_link text-center btn btn-danger w-100 mt-3" id="closeMenuButton"
                style="border-radius: 0; background-color: #ff0000; color: #fff; font-weight: bold;" onclick=" document.getElementById('nav-bar').classList.remove('show');
                document.getElementById('nav-bar').style.display='none' ;">
                Close Menu
            </button>


            <a href="{{ route('logout') }}" class="nav_link">
                <i class="bx bx-log-out nav_icon"></i>
                <span class="nav_name">Sign Out</span>
            </a>
        </nav>
    </div>

    <!--Container Main start-->
    <div class="height-100 bg-light w-100">
        <main class="container-fluid">
            @if ($message = Session::get('success'))
            <div class="container">
                <div class="alert alert-success" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            </div>
            @endif @if ($message = Session::get('error'))
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $(".alert").delay(3000).fadeOut(500);

            $('[data-bs-toggle="tooltip"]').tooltip();

            // Dropdown functionality
            $('#masterDataLink').on('click', function() {
                $('#masterDataDropdown').slideToggle("slow");
                $('#dropdownIconMaster').toggleClass('bx-chevron-down');
            });

            $('#laporanLink').on('click', function() {
                $('#laporanDropdown').slideToggle("slow");
                $('#dropdownIconLaporan').toggleClass('bx-chevron-down');
            });
            $('#rekapLink').on('click', function() {
                $('#rekapDropdown').slideToggle("slow");
                $('#dropdownIconRekap').toggleClass('bx-chevron-down');

            });

            $('#header-toggle').on('click', function() {
                const body = document.getElementById('body-pd');
                const header = document.getElementById('header');
                const navBar = document.getElementById('nav-bar');
                body.classList.toggle('body-pd');
                header.classList.toggle('body-pd');
                navBar.classList.toggle('show');
                if (navBar.classList.contains('show')) {
                    navBar.style.display = 'block';
                } else {
                    navBar.style.display = 'none';
                }


            });           
            const navBar = document.getElementById('nav-bar');
            const headerToggle = document.getElementById('header-toggle');
      
            if (window.innerWidth > 768) {
                navBar.classList.remove('show');
                navBar.style.display = 'block';
                headerToggle.style.display = 'none';
            } else {
                navBar.style.display = 'none';
                headerToggle.style.display = 'block';
            }
        });
             //watch width
        window.addEventListener('resize', function() {
            const navBar = document.getElementById('nav-bar');
            const headerToggle = document.getElementById('header-toggle');
            if (window.innerWidth > 768) {
                navBar.classList.remove('show');
                navBar.style.display = 'block';
                headerToggle.style.display = 'none';
            } else {
                navBar.style.display = 'none';
                headerToggle.style.display = 'block';
            }
        });
        

       
    </script>
    @yield('scripts')
</body>

</html>