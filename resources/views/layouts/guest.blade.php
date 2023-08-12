<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    {{-- meta --}}
    @include('components._meta')
</head>


<body>

<main>
    <section>
        @yield('content')
    </section>
</main>

{{-- Script --}}
@include('components._script')
</body>
</html>
