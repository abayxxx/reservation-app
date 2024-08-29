<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Kepuasan Konsumen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('landing_page/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landing_page/css/responsive.css')}}">
    <link rel="icon" href="{{ asset('landing_page/images/fevicon.png')}}" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>

<body>
    <div class="d-flex justify-content-center align-middle min-vh-100">
        <div class="card card-block" style="width:500px; height:100vh">
            <div class="text-center my-auto">
                <div class="">
                    <h1 class="mb-5">DETAIL MENU</h1>
                </div>
                <div class="px-5">
                    <div class="row">
                        <div class="col">
                            <div>
                                <img src="{{asset('landing_page/images/about-img.png')}}" alt="" style="width: 500px;">
                            </div>
                            <div class="text-left mb-3">
                                <span class="font-weight-bold">Nama Menu: {{$menu->name}}</span><br>
                                <span class="font-weight-bold">Harga Menu: {{$menu->price}}</span><br>
                                <span class="font-weight-normal">Deskripsi: {{$menu->description}}</span>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div>
                        <div>
                            <button class="btn btn-outline-success mb-3">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript files-->
    <script src="{{asset('landing_page/js/jquery.min.js')}}"></script>
    <script src="{{asset('landing_page/js/popper.min.js')}}"></script>
    <script src="{{asset('landing_page/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landing_page/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('landing_page/js/plugin.js')}}"></script>
    <script src="{{asset('landing_page/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('landing_page/js/custom.js')}}"></script>
    <script>
        $(document).ready(function() {
            //redirect to order page
            $('.btn').click(function() {
                window.location.href = "{{route('order.guest')}}";
            });
        });

        // Scrolling Effect

        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>
</body>

</html>