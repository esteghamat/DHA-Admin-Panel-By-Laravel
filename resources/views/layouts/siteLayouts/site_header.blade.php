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
            <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset(config('constants.frontend_address').'/dha-images/Vector Smart Object1.png') }}" alt=""></a>
            </div>

            <div class="nav-links">
                <ul>
                    <li><a href="{{ url('/') }}">ANASAYFA</a></li>
                    <li><a href="{{ url('biz-kimiz') }}">BİZ KİMİZ</a></li>
                    <li><a href="{{ url('dijital-recetemiz') }}">DİJİTAL REÇETEMİZ</a></li>
                    <li><a href="{{ url('references') }}">REFERANSLAR</a></li>
                    <li><a href="{{ url('islerimiz') }}">İŞ ÖRNEKLERİ</a></li>
                    <li><a href="{{ url('blog') }}">BLOG</a></li>
                    <li><a href="{{ url('contact') }}">RANDEVU</a></li>
                </ul>    
             </div>
        </nav>
