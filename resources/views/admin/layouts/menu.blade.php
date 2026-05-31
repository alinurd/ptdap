@php
    $bannerMenus = [
        [
            'route' => 'admin.master.banner.index',
            'title' => 'Home Banner',
            'icon'  => 'ti ti-home',
        ],
        [
            'route' => 'admin.master.banner-halaman.index',
            'title' => 'Banner Halaman',
            'icon'  => 'ti ti-layout',
        ],
    ];

    $masterDataMenus = [
        [
            'route' => 'admin.master.bisnis-kategori.index',
            'title' => 'Bisnis Kategori',
            'icon'  => 'ti ti-category',
        ],
        [
            'route' => 'admin.master.company.index',
            'title' => 'Mengenai Kami',
            'icon'  => 'ti ti-building',
        ],
        [
            'route' => 'admin.master.customer.index',
            'title' => 'Mitra Strategis',
            'icon'  => 'ti ti-handshake',
        ],
        [
            'route' => 'admin.master.pengalaman.index',
            'title' => 'Pengalaman Kami',
            'icon'  => 'ti ti-star',
        ],
        [
            'route' => 'admin.master.personil.index',
            'title' => 'Personil Manajemen',
            'icon'  => 'ti ti-users',
        ],
        [
            'route' => 'admin.master.iso.index',
            'title' => 'Sertifikasi',
            'icon'  => 'ti ti-certificate',
        ],
    ];

    $dokumenMenus = [
        [
            'route' => 'admin.master.dokumen-kategori.index',
            'title' => 'Kategori',
            'icon'  => 'ti ti-folder',
        ],
        [
            'route' => 'admin.master.dokumen.index',
            'title' => 'Dokumen',
            'icon'  => 'ti ti-file',
        ],
    ];

    $beritaMenus = [
        [
            'route' => 'admin.master.berita-kategori.index',
            'title' => 'Kategori',
            'icon'  => 'ti ti-tag',
        ],
        [
            'route' => 'admin.master.berita.index',
            'title' => 'Berita',
            'icon'  => 'ti ti-news',
        ],
    ];
@endphp

<ul class="menu-inner py-1">

  {{-- Dashboard --}}
  <li class="menu-item {{ isActiveRoute('admin.dashboard') }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-smart-home"></i>
      <div data-i18n="Dashboard">Dashboard</div>
    </a>
  </li>

  {{-- Section: Databases --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Konten Website</span>
  </li>

  {{-- Banner --}}
  <li class="menu-item {{ isActiveOpen(['admin.master.banner.*', 'admin.master.banner-halaman.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-photo"></i>
      <div>Banner</div>
    </a>
    <ul class="menu-sub">
      @foreach ($bannerMenus as $item)
        <li class="menu-item {{ isActiveRoute($item['route']) }}">
          <a href="{{ route($item['route']) }}" class="menu-link">
            <div>{{ $item['title'] }}</div>
          </a>
        </li>
      @endforeach
    </ul>
  </li>

  {{-- Master Data --}}
  <li class="menu-item {{ isActiveOpen(['admin.master.bisnis-kategori.*', 'admin.master.company.*', 'admin.master.customer.*', 'admin.master.pengalaman.*', 'admin.master.personil.*', 'admin.master.iso.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-database"></i>
      <div>Master Data</div>
    </a>
    <ul class="menu-sub">
      @foreach ($masterDataMenus as $item)
        <li class="menu-item {{ isActiveRoute($item['route']) }}">
          <a href="{{ route($item['route']) }}" class="menu-link">
            <div>{{ $item['title'] }}</div>
          </a>
        </li>
      @endforeach
    </ul>
  </li>

  {{-- Dokumen --}}
  <li class="menu-item {{ isActiveOpen(['admin.master.dokumen-kategori.*', 'admin.master.dokumen.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-files"></i>
      <div>Dokumen</div>
    </a>
    <ul class="menu-sub">
      @foreach ($dokumenMenus as $item)
        <li class="menu-item {{ isActiveRoute($item['route']) }}">
          <a href="{{ route($item['route']) }}" class="menu-link">
            <div>{{ $item['title'] }}</div>
          </a>
        </li>
      @endforeach
    </ul>
  </li>

  {{-- Berita --}}
  <li class="menu-item {{ isActiveOpen(['admin.master.berita-kategori.*', 'admin.master.berita.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-news"></i>
      <div>Berita</div>
    </a>
    <ul class="menu-sub">
      @foreach ($beritaMenus as $item)
        <li class="menu-item {{ isActiveRoute($item['route']) }}">
          <a href="{{ route($item['route']) }}" class="menu-link">
            <div>{{ $item['title'] }}</div>
          </a>
        </li>
      @endforeach
    </ul>
  </li>

  {{-- User Management --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">User Management</span>
  </li>
  <li class="menu-item {{ isActiveRoute('admin.userman.user.view') }}">
    <a href="{{ route('admin.userman.user.view') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-users"></i>
      <div>Users</div>
    </a>
  </li>
  <li class="menu-item {{ isActiveOpen(['admin.userman.role.*', 'admin.userman.permission.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-settings"></i>
      <div>Roles & Permissions</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{ isActiveRoute('admin.userman.role.view') }}">
        <a href="{{ route('admin.userman.role.view') }}" class="menu-link">
          <div>Roles</div>
        </a>
      </li>
      <li class="menu-item {{ isActiveRoute('admin.userman.permission.view') }}">
        <a href="{{ route('admin.userman.permission.view') }}" class="menu-link">
          <div>Permission</div>
        </a>
      </li>
    </ul>
  </li>

  {{-- Settings --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Settings</span>
  </li>
  <li class="menu-item {{ isActiveRoute('admin.setting.appsetting.index') }}">
    <a href="{{ route('admin.setting.appsetting.index') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-table-options"></i>
      <div>App Settings</div>
    </a>
  </li>

</ul>
