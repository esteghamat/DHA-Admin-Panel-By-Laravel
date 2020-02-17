@extends('layouts.siteLayouts.site_main')

@section('content')

        <div class="digital-1">
            <!-- <div><h1><span> Dijital Reçetemiz</span></h1></div> -->
            <div><h1><span> {{ $contentheads->contenthead_title }} </span></h1></div>
            <div>
              <p>
                <!-- Saglık ile ilgili ozel hizmetler -->
                <?php 
                  echo(nl2br($contentheads->contenthead_title_description));
                ?>  
                <!-- <img src="{{ asset('frontend_assets/dha-images/Vector Smart Object3.png') }}" alt=""> -->
                <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentheads->contenthead_logo_image_name	}}" alt="">
              </p>
            </div>
        </div>

        @foreach($contentitems as $contentitem)
        <section class="dcontainer">
            <div>
                <div><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt=""></div>
                <div>
                  <h3>
                    <span class="span1">
                      <span class="span2">
                        {{ $contentitem->contentitem_title }}
                      </span>
                    </span>
                  </h3>
                </div> 
                <div>
                    <p>
                      {{ $contentitem->contentitem_title_description }}
                      <br><br>
                      <?php 
                        echo(nl2br($contentitem->contentitem_description));
                      ?>  
                    </p>
                </div>
            </div>
        </section>
        @endforeach

        <!-- <section class="dcontainer">
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/dijitalrecete1.jpg') }}" alt=""></div>
                <div><h3><span class="span1"><span class="span2">GRAFİK TASARIM</span></span></h3></div> 
                <div>
                    <p>Alanınıza özel kreatif grafik çalışmaları, animasyonlar, vektörel çalışmalar<br><br>
                        Logo, kartvizit, antetli kağıt,<br>
                        ajanda, kalem gibi ürünler<br>
                        tasarlar ve sizin için kurumsal kimlik<br>
                        oluştururuz. Sosyal medya tasarımları,<br>
                        afiş ve broşür tasarımları hazırlıyoruz.<br>  
                    </p>
                </div>
            </div>
        </section>
        <section class="dcontainer">
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/dijitalrecete2.jpg') }}" alt=""></div>
                <div><h3><span class="span1"><span class="span2">FOTOGRAF & VİDEO</span></span></h3></div> 
                <div>
                    <p>Arama motoru optimizasyonu, Dijital birliğin artması<br><br>
                        Markanızın arama motorlarında daha<br>
                        üst sıralarda çıkmasını sağlıyor,<br>
                        dijital repütasyonunuzu yükseltiyoruz.<br> 
                    </p>
                </div>
            </div>
        </section>
        <section class="dcontainer">
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/dijitalrecete3.jpg') }}" alt=""></div>
                <div><h3><span class="span1"><span class="span2">GOOGLE ADS & SEO</span></span></h3></div> 
                <div>
                    <p> Konsept fotoğraf ve video çekimler<br><br>
                        Profesyonel makine ve uzman ekibimizle <br>
                        muayenehane, hastane, poliklinik ve <br>
                        ameliyathane çekimleri yapıyor, <br>
                        hastalarınızın sizi görmesini sağlıyoruz. <br> 
                        Youtube kanalınıza yüklenmesi <br>
                        işlemlerini yapıyoruz.  
                    </p>
                </div>
            </div>
        </section> -->

@endsection