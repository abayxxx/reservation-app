<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Kepuasan Konsumen</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('landing_page/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('landing_page/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('landing_page/images/fevicon.png')}}" type="image/gif" />
    <!-- font css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>

<body>
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/" style="font-weight: 900;">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#about-sec">About</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#menu-sec" style="font-weight: 900;">SERVICES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('guest.pertanyaan')}}" style="font-weight: 900;">Questionnaire</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div class="container">
                <div id="banner_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="banner_taital_main">
                                        <h1 class="banner_taital text-white">PT.BEST</h1>
                                        <h5 class="tasty_text">Inovasi Kenyamanan AC</h5>
                                        <p class="banner_text text-white">Jangan lewatkan pengalaman udara sejuk dan kenyamanan istimewa dengan layanan AC unggulan kami. Jadikan setiap momen lebih nyaman dan segar.</p>
                                        <div class="btn_main">
                                            <div class="about_bt"><a href="#about-sec">About Us</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- coffee section start -->
    <div class="coffee_section layout_padding" id="menu-sec">
        <div class="container">
            <div class="row">
                <h1 class="coffee_taital">OUR SERVICES OFFER</h1>
                <div class="bulit_icon"><img src="{{asset('landing_page/images/bulit-icon.png')}}"></div>
            </div>
        </div>
        <div class="coffee_section_2">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="coffee_img"><img style="height: 250px;" src="{{asset('landing_page/images/i1.jpg')}}"></div>
                                    <h3 class="types_text">PEMBERSIHAN AC</h3>
                                    <p class="looking_text">Membersihkan unit AC dari debu</p>
                                    <div class="read_bt"><a href="#">Read More</a></div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="coffee_img"><img style="height: 250px;" src="{{asset('landing_page/images/i2.jpg')}}"></div>
                                    <h3 class="types_text">PERBAIKAN AC CEPAT</h3>
                                    <p class="looking_text"> Solusi tepat untuk masalah AC</p>
                                    <div class="read_bt"><a href="#">Read More</a></div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="coffee_img"><img style="height: 250px;" src="{{asset('landing_page/images/i3.jpg')}}"></div>
                                    <h3 class="types_text">INSTALASI AC</h3>
                                    <p class="looking_text">Pasang AC baru dengan presisi</p>
                                    <div class="read_bt"><a href="#">Read More</a></div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="coffee_img"><img style="height: 250px;" src="{{asset('landing_page/images/i4.jpg')}}"></div>
                                    <h3 class="types_text">LAYANAN DARURAT 24/7O</h3>
                                    <p class="looking_text">Tanggap darurat siang malam</p>
                                    <div class="read_bt"><a href="#">Read More</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- coffee section end -->
    <!-- about section start -->
    <div class="about_section layout_padding" id="about-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="about_taital">About US</h1>
                    <div class="bulit_icon"><img src="{{asset('landing_page/images/bulit-icon.png')}}"></div>
                </div>
            </div>
            <div class="about_section_2 layout_padding">
                <div class="image_iman"><img style="height: 500px;" src="{{asset('landing_page/images/b2.jpg')}}" class="about_img"></div>
                <div class="about_taital_box mt-5">
                    <h1 class="about_taital_1">SELAMAT DATANG DI PT.BEST</h1>
                    <p class=" about_text">PT. BEST merupakan perusahaan yang bergerak d bidang jasa,penjualan dan distribusi. PT. BEST juga memiliki produk produk yang diakui kualitas nya oleh pengguna. PT. BEST tumbuh menjadi perusahaan yang memiliki rekam jejak bagus dikalangan pelanggan nya dan semua kesuksesan ini berhasil diraih berkat bantuan dan support yang tanpa henti didapat dari management dan para partner bisnis kami.</p>

                    <div class="readmore_btn"><a href="#">Read More</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->


    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="address_text">Address</h1>
                    <p class="footer_text">Medan, North Sumatra, Indonesia</p>
                    <!-- <p class="footer_text mt-3">Stay connected with us on social media for the latest updates, offers, and coffee inspiration.</p> -->
                    <div class="location_text">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">+01 1234567890</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_10">demo@gmail.com</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <p class="copyright_text">2023 All Rights Reserved. </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="footer_social_icon">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{asset('landing_page/js/jquery.min.js')}}"></script>
    <script src="{{asset('landing_page/js/popper.min.js')}}"></script>
    <script src="{{asset('landing_page/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('landing_page/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('landing_page/js/plugin.js')}}"></script>
    <!-- sidebar -->
    <script src="{{asset('landing_page/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('landing_page/js/custom.js')}}"></script>
</body>

</html>