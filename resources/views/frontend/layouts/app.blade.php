@php $set = AppSetting::first(); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? ($set?->title ?? 'PT Delta Angkasa Pratama') }}</title>
    <meta name="description" content="{{ $description ?? $set?->meta_description ?? 'PT Delta Angkasa Pratama' }}">
    <link rel="icon" type="image/x-icon" href="{{ $set?->favicon ? asset($set->favicon) : asset('assets/img/favicon.ico') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? $set?->title }}">
    <meta property="og:description" content="{{ $description ?? $set?->meta_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}">
    <!-- Font Awesome (for social icons) -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}">
    <!-- Frontend CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
    @yield('styles')
</head>
<body>

    @include('frontend.layouts.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function swAlert(type, msg) {
        Swal.fire({
            title: type === 'error' ? 'Gagal!' : 'Berhasil!',
            text: msg,
            icon: type === 'error' ? 'error' : 'success',
            confirmButtonText: 'Oke',
            customClass: { confirmButton: 'btn btn-primary' },
            buttonsStyling: false
        });
    }
    </script>
    @yield('scripts')
</body>
</html>
