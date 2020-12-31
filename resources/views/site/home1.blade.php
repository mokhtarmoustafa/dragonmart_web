<!DOCTYPE html>
<html lang="ar" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include(site_layout_vw().'.css')
    <link rel="stylesheet" href="{{url('/assets')}}/site/css/rtl-style.css">


    <title>Dragon Mart</title>
    <script src="https://unpkg.com/eva-icons"></script>
  </head>
  <body>

    <div class="header">
      <div class="logo">
        <img src="{{url('assets/site/images/white_logo.png')}}">
      </div>
      <div class="menu hidden">
        <ul>
          <li><a href="#">من نحن</a></li>
          <li><a href="#">مميزات التطبيق</a></li>
          <li><a href="#">لوحة التحكم</a></li>
          <li><a href="#">زد دخلك</a></li>
          <li><a href="#">نطاقنا</a></li>
          <li><a href="#">شركاؤنا</a></li>
        </ul>

      </div>
      <div class="social">
        <a href="#"><i class="SP">920011721</i></a>
        <a href="https://www.instagram.com/dragonmart_ksa/"><i class="ion-social-instagram"></i></a>
        <a href="https://www.snapchat.com/add/dragonmart_ksa"><i class="ion-social-snapchat"></i></a>
        <a href="https://twitter.com/dragonmart_ksa"><i class="ion-social-twitter"></i></a>
      </div>
    </div>


    <section class="main">
      <a href="https://maroof.sa/133413" class="maroof">
        <img src="https://maroof.sa/Content/Stamps/ImageCr.png" height="50">
      </a>
      <div class="row">
        <div class="col-md-4">
          <div class="Phone">
            <img class="phone2" src="{{url('assets/site/images/phone2.png')}}" alt="">
            <img class="phone1" src="{{url('assets/site/images/phone1.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-8  white">
          <h1 class="Det">
            <b class="YellowText">دراغون مارت</b>
          تطبيق الكتروني متخصص لتسويق و توصيل المنتجات و تقديم الخدمات
          </h1>
          <h5 class="Det">
            <span class="P-10-25">انضم معنا</span>
            <a href="login" class="btn btn-outline btn-radius P-10-25">تسجيل كتاجر</a>
          </h5>
          <div class="Download center">
            <h2 class="w-100">للتسوق قم بتحميل التطبيق</h2>
            <div class="">
              <a href="https://apps.apple.com/us/app/dragon-mart/id1523014369" target="_blank"><img src="{{url('assets/site/images/IOS.png')}}" alt=""></a>
              <a href="https://play.google.com/store/apps/details?id=com.saudidragonmart.app" target="_blank"><img src="{{url('assets/site/images/Android.png')}}" alt=""></a>
            </div>
          </div>
        </div>

      </div>

    </section>

  </body>
</html>
