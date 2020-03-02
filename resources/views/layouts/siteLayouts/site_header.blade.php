<body>
    <div class="website">
        <div href="" class="hamburger">
            <div>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="navigation">
            <div class="logo"><a href="{{ url('/') }}"><img class="site-logo" src="{{ asset(config('constants.frontend_address').'/dha-images/logo.jpg') }}" alt=""></a>
            </div>

            <div class="nav-links">
                <ul>
                    <li><a href="{{ url('/') }}">ANASAYFA</a></li>
                    <li><a href="{{ url('biz-kimiz') }}">BİZ KİMİZ</a></li>
                    <li><a href="{{ url('dijital-recetemiz') }}">DİJİTAL HİZMETLER</a></li>
                    <li><a href="{{ url('references') }}">TEDAVİ ETTİKLERİMİZ</a></li>
                    <li><a href="{{ url('islerimiz') }}">İŞ ÖRNEKLERİ</a></li>
                    <li><a href="{{ url('blog') }}">BLOG</a></li>
                    <li ><a href="{{ url('contact') }}" class="bordered"><i class="fas fa-stethoscope" style="font-size: 16px;"></i>  RANDEVU</a></li>
                </ul>    
             </div>
        </nav>
        <div class="social-fixed">
            <a href="#"><i class="fab fa-whatsapp fix-social" style="font-size: 28px !important;"></i></a>
            <a href="#"><i class="fas fa-phone-square-alt fix-social"></i></a>
            <a href="#"><i class="far fa-envelope fix-social"></i></a>
        </div>