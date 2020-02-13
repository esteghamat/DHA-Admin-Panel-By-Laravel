@extends('layouts.siteLayouts.site_main')

@section('content')


        <div id="who">
            <!-- <h1>Biz Kimiz?</h1> -->
            <h1>{{ $contentheads->contenthead_title }}</h1>
        </div>
        <section class="whoweare">
            <div>
            <!-- <p>
                DHA, sadece sağlık sektörüne hizmet veren, alanında uzman ekibiyle kurulan dijital sağlık ajansıdır.<br><br>
                Dijital pazarlama ve dijital repütasyonun öneminin yadsınamadığı günümüzde zaten işleri
                başından aşkın olan hekim ve kliniklerin bu alana ayırmaları gereken zaman<br><br>
                ve enerjilerini koruyabilmeleri amacıyla ortaya çıkmıştır.<br><br>
                Siz bir çok yaşamı görünür kılarken, biz de sosyal medya hesaplarınızı görünür yapıyoruz.<br><br>
                DHA; doğru tedaviyle markanızı iyileştir, çözüm üretir, yaratıcı fikirler geliştirir.<br><br>
                Siz dünyayı iyileştirmeye devam edin gerisini biz hallederiz!
            </p> -->
            <p>
                <?php 
                    echo(nl2br($contentheads->contenthead_title_description));
                ?>  
            </p>
            </div>
        </section>
        <section class="whoweare-container">
            @foreach($contentitems as $contentitem)
            <div>
                <div><<img src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $contentitem->contentitem_logo_image_name	}}" alt=""></div>
                <div><h5>{{ $contentitem->contentitem_title }}</h5></div>
                <div>
                  <p>
                    <?php 
                      echo(nl2br($contentitem->contentitem_title_description));
                    ?>  
                  </p>
                </div>
            </div>
            @endforeach
            <!-- <div>
                <div><img src="{{ asset('frontend_assets/dha-images/1.png') }}" alt=""></div>
                <div><h5>SOSYAL MEDYA YÖNETİMİ</h5></div>
                <div><p>Uzman grafiker ve editörlerimizle sosyal medya hesabınızı analiz ediyor,
                     ihtiyaca uygun düzenliyor, büyütüyor ve raporluyoruz.
                </p></div>
            </div>
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/2.png') }}" alt=""></div>
                <div><h5>İÇERİK YÖNETİM VE YAZARLIĞI</h5></div>
                <div><p>Konusunda deneyimli metin yazarları ile branşınıza uygun içerikler
                     ve bloglar üretiyor, SEO çalışmalarıyla isminizi arama motorlarında üst sıralara taşıyoruz.
                </p></div>
            </div>
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/3.png') }}" alt=""></div>
                <div><h5>REPÜTASYON YÖNETİMİ</h5></div>
                <div><p>Dijital medyadaki kimlikleriniz; sosyal 
                    medya hesaplarınız ve web sitenizi sizi en iyi
                     yansıtacak duruma getiriyoruz, bilinirlik ve güvenilirliğinizi ön plana çıkartıyoruz.

                </p></div>
            </div>
            <div>
                <div><img src="{{ asset('frontend_assets/dha-images/4.png') }}" alt=""></div>
                <div><h5>PRODÜKSİYON</h5></div>
                <div><p>Söz uçar, görüntü kalır! Alanınızda röportaj,
                     bilgi paylaşımı ve tanıtım filmleri hazırlıyor, tanınırlığınızı besliyoruz.
                </p></div>
            </div> -->
        </section>

@endsection