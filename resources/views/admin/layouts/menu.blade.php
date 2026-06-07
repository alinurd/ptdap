@php use App\Data\AdminMenus; @endphp

<ul class="menu-inner py-1">

  {{-- Dashboard --}}
  <li class="menu-item {{ isActiveRoute('admin.dashboard') }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-smart-home"></i>
      <div data-i18n="Dashboard">Dashboard</div>
    </a>
  </li>

  @foreach (AdminMenus::sections() as $section)

    {{-- Section Header --}}
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ $section['header'] }}</span>
    </li>

    @foreach ($section['groups'] as $group)

      @if (!empty($group['direct']))
        {{-- Direct link (tidak dropdown) --}}
        <li class="menu-item {{ isActiveRoute($group['route']) }}">
          <a href="{{ route($group['route']) }}" class="menu-link">
            <i class="menu-icon tf-icons {{ $group['sidebar_icon'] }}"></i>
            <div>{{ $group['title'] }}</div>
          </a>
        </li>

      @else
        {{-- Dropdown --}}
        @php
          // Konversi 'admin.master.banner.index' → 'admin.master.banner.*'
          $groupRoutes = array_map(
              fn($item) => preg_replace('/\.[^.]+$/', '.*', $item['route']),
              $group['items']
          );
        @endphp
        <li class="menu-item {{ isActiveOpen($groupRoutes) }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons {{ $group['sidebar_icon'] }}"></i>
            <div>{{ $group['title'] }}</div>
          </a>
          <ul class="menu-sub">
            @foreach ($group['items'] as $item)
              <li class="menu-item {{ isActiveRoute($item['route']) }}">
                <a href="{{ route($item['route']) }}" class="menu-link">
                  <div>{{ $item['label'] }}</div>
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @endif

    @endforeach

  @endforeach

</ul>
