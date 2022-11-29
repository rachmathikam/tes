<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/101.png') }}" alt="" width="50">
        </div>
        <div class="sidebar-brand-text" style="font-size: 10px;">Pendidikan Integral Luqman Al-hakim</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    @if (Auth::user()->role_id == '1')
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Dashboard
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
    data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Users:</h6>
        <a class="collapse-item" href="{{ route('siswa.index') }}">Siswa</a>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mapel.index') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Mata Pelajaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-university"></i>
            <span>Manajemen Sekolah</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('kelas.index') }}">Kelas Mapel</a>
                <a class="collapse-item" href="{{ route('detailkelas.create') }}"> Tambah Kelas Mapel</a>
                <a class="collapse-item" href="{{ route('kelas_siswa.index') }}"> Kelas Siswa</a>
                <a class="collapse-item" href="{{ route('tahunpelajaran.index') }}"> Tahun Periodik</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Penilaian</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Penilaian Ujian:</h6>
                <a class="collapse-item" href="{{ route('nilai_siswa.index') }}">Penilaian PTS</a>
                <a class="collapse-item" href="blank.html">Penilaian PAS</a>
            </div>
        </div>
</li>
@endif
@if(Auth::user()->role_id == '2')


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Guru Dasboard
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('mapel.index') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Mata Pelajaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <i class="fa fa-fw fa-university"></i>
            <span>Kelas</span></a>
    </li>

    @endif
    @if(Auth::user()->role_id == '3')
    <div class="sidebar-heading">
        Siswa Dasboard
    </div>

    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-book"></i>
            <span>Jadwal Pelajaran </span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fa-solid fa-fw fa-book-bookmark"></i>
            <span>Lihat Raport </span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->

</ul>
