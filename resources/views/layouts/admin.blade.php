<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    {{-- meta --}}
    @include('components._meta')
</head>


<body>
    {{-- [ Header ] start --}}
    @include('components._nav')

    {{-- [ navigation menu ] start --}}
    @include('components._sidebar')

    <main id="main" class="main" style="margin-bottom: 100px;">
        {{-- [ breadcrumb ] start --}}
        @include('components._bread')

        <section class="section dashboard">
            @yield('content')
        </section>
    </main>

    {{-- [ footer ] start --}}
    @include('components._footer')


    {{-- Script --}}
    @include('components._script')
</body>

</html>