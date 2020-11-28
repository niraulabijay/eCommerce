<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/cart-logo.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.16/css/uikit.min.css"/>


    {{--//metis menu--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.min.css">

    <!-- include  css/js -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">


    <link rel="stylesheet" href="{{asset('front/css/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    {{--<link rel="stylesheet" href="{{asset('front/css/stripe.css')}}">--}}
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    @yield('styles')

</head>
<body>
<div class="uk-offcanvas-content">
    @include('front.nav_bar')
    @yield('content')
    <section class="news_letter">
        <div class="container">
            <hr>
        </div>
        <div class="container">
            <div class=" p-5 mt-3 text-center">
                <div class="heading mb-3">
                    <h3>Be the first to get updates and special offers.</h3>
                </div>
                <div class="">
                    <form action="{{route('post_subscriber')}}" method="post" class="d-flex justify-content-center pb-3 mb-3">
                        @csrf
                        <input type="email"  name="email" class="uk-input" placeholder="Sign up to our mailing list..." required>
                        <button class="checkout uk-button">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 ">
                    <div class="footer_title">
                        <div class="heading">
                            <h3>About Us</h3>
                        </div>
                    </div>
                    <div class="footer_list">
                        <p>{!! isset($setting) ? $setting->brief_about_us : '' !!}</p>
                    </div>
                    <div class="footer_list">
                        <ul>
                            <li class="footer_list--item1"><i
                                        class="icofont-map-pins icofont-2x"></i> {{ isset($setting) ? $setting->address : ''}}</li>
                            <li class="footer_list--item1"><i
                                        class="icofont-telephone icofont-2x"></i>01-<a href="tel:+977{{ isset($setting) ? $setting->company_number : '' }}">{{ isset($setting) ? $setting->company_number : '' }}</a></li>
                            <li class="footer_list--item1"><i class="icofont-email icofont-2x"></i>
                                Email: <a href="mailto:{{ isset($setting) ? $setting->email : '' }}">{{ isset($setting) ? $setting->email : '' }}</a></li>
                        </ul>


                    </div>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <div class="footer_title">
                        <div class="heading">
                            <h3>Information</h3>
                        </div>
                    </div>
                    <div class="footer_list">
                        <ul>
                            <li class="footer_list--item"><a href="/contact"><i class="icofont-link-alt"></i>contact us</a>
                            </li>
                            <li class="footer_list--item"><a href="/about"><i class="icofont-link-alt"></i>about us</a>
                            </li>
                            {{--<li class="footer_list--item"><a href=""><i class="icofont-link-alt"></i>  Delivery Information</a></li>--}}
                            <li class="footer_list--item"><a href="{{ route('privacy_policies') }}"><i
                                            class="icofont-link-alt"></i> Pivacy Policy</a></li>
                            <li class="footer_list--item"><a href="{{ route('terms_and_conditions') }}"><i
                                            class="icofont-link-alt"></i> Term & Conditions</a></li>
                            {{--<li class="footer_list--item"><a href=""><i class="icofont-link-alt"></i> Help</a></li>--}}
                        </ul>


                    </div>
                </div>
                <div class=" col-md-4 col-sm-12">
                    <div class="footer_title">
                        <div class="heading">
                            <h3>Customer Service</h3>
                        </div>
                    </div>
                    <div class="footer_list">
                        <ul>
                            @if(Sentinel::check())
                                <li class="footer_list--item"><a href="{{  route('user_info') }}"><i class="icofont-link-alt"></i>Account</a>
                                </li>
                                <li class="footer_list--item"><a href="/user/orders"><i class="icofont-link-alt"></i> Order</a></li>
                                <li class="footer_list--item"><a href="/user/wishlists"><i class="icofont-link-alt"></i>Wishlist</a>
                                </li>
                            @else
                                <li class="footer_list--item"><a href="/login"><i class="icofont-link-alt"></i>Login</a>
                                </li>
                                <li class="footer_list--item"><a href="/register"><i class="icofont-link-alt"></i>Register</a>
                                </li>
                                <li class="footer_list--item"><a href="/order_track"><i class="icofont-link-alt"></i>Track
                                        Order</a></li>
                            @endif
                            {{--<li class="footer_list--item"><a href=""><i class="icofont-link-alt"></i>Special</a></li>--}}
                            {{--<li class="footer_list--item"><a href=""><i class="icofont-link-alt"></i>Site Map</a></li>--}}
                        </ul>
                    </div>


                </div>
            </div>
            <hr>
            <div class="social_icons">
                <ul class="d-flex align-items-center justify-content-between ">
                    <li>
                        <div class="heading">
                            <h3>Follow Us</h3>
                        </div>
                    </li>

                    <li class=" "><a href="{{ isset($setting) ? $setting->facebook_link : '' }}"> <span uk-icon="facebook"
                                                                                 class="facebook"></span><span>facebook</span>
                        </a></li>
                    <!--<li class=" "><a href=""> <span uk-icon="google-plus"-->
                    <!--                                class="google-plus"></span><span>google plus</span></a></li>-->
                    <li class=" "><a href="{{ isset($setting) ? $setting->twitter_link : '' }}"> <span uk-icon="twitter"
                                                                                class="twitter"></span><span>twitter</span></a>
                    </li>
                    <li class=" "><a href="{{ isset($setting) ? $setting->instagram_link : '' }}"> <span uk-icon="instagram"
                                                                                  class="instagram"></span><span>instagram</span></a>
                    </li>
                    <li class=" "><a href="{{ isset($setting) ? $setting->youtube_link : '' }}"> <span uk-icon="youtube"
                                                                                class="youtube"></span><span>youtube</span></a>
                    </li>
                    <!--<li class=" "><a href=""> <span uk-icon="tumblr" class="tumblr"></span><span>tumblr</span></a></li>-->
                    <!--<li class=" "><a href=""> <span uk-icon="pinterest" class="pinterest"></span><span>pinterest</span></a>-->
                    <!--</li>-->

                </ul>
            </div>

        </div>


    </footer>
    <footer id="mini-footer">
        <p>Powered by <a href="" style="color: #d3232a"> Next Nepal</a></p>
    </footer>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<!-- Include English language -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.16/js/uikit.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.16/js/uikit-icons.min.js"></script>
<!-- Owl carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- metis menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.8/metisMenu.js"></script>

<!-- wow js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<script src="{{asset('front/js/xzoom.min.js')}}"></script>
<script src="{{asset('front/js/app.min.js')}}"></script>
@include('sweetalert::alert')
@yield('script')
</body>
</html>