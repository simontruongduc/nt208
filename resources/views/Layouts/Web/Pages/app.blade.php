<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{asset('')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>
    <!--
        CSS
        ============================================= -->
    <link rel="stylesheet" href="css/linearicons.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/nice-select.min.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.min.css"/>
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.min.css"/>
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <link rel="stylesheet" href="css/main.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172007460-1"></script>
    <script>
      window.dataLayer = window.dataLayer || []

      function gtag () {dataLayer.push(arguments)}

      gtag('js', new Date())

      gtag('config', 'UA-172007460-1')
    </script>
    @yield('css')

</head>

<body>
@component('Layouts.Web.Components.header')
@endcomponent

@yield('content')
@component('Layouts.Web.Components.footer')
@endcomponent
<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.min.js"></script>
{{--<script src="js/nouislider.min.js"></script>--}}
{{--<script src="js/countdown.min.js"></script>--}}
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.min.js"></script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function () {
    FB.init({
      xfbml: true,
      version: 'v7.0',
    })
  };

  (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0]
    if (d.getElementById(id)) return
    js = d.createElement(s)
    js.id = id
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js'
    fjs.parentNode.insertBefore(js, fjs)
  }(document, 'script', 'facebook-jssdk'))</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="109239384184754"
     theme_color="#ff7e29"
     logged_in_greeting="Xin chào. Chúng tôi có thể giúp gì cho bạn?"
     logged_out_greeting="Cảm ơn bạn đã quan tâm đến chúng tôi. Chúc bạn một ngày vui vẻ!">
</div>
@yield('js')
</body>

</html>
