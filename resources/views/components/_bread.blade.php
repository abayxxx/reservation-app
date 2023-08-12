<div class="pagetitle">
    <h1>@yield('title-1')</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="@yield('link')">@yield('title-2')</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->