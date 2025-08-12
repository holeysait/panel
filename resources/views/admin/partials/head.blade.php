@php
    $ver = file_exists(public_path('assets/admin.css')) ? filemtime(public_path('assets/admin.css')) : time();
@endphp
<link rel="stylesheet" href="{{ asset('assets/admin.css') }}?v={{ $ver }}">
