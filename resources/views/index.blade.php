@extends('layouts.siteLayouts.site_main')

@section('content')

<?php
// dd(Config::get('constants.frontend_address'));
?>
        <header>
            <section class="header">
                <div class="header-left"><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/3-03.png') }}" alt="">
                </div>

                <div class="header-right">
                    <div><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/Vector Smart Object.png') }}" alt=""></div>
                    <div>
                        <?php
                          $contentheads_anasayfa = $contentheads->filter(function($item)
                              {
                                  if($item->site_content_type->contenttype_slug == 'anasayfa')
                                  {
                                      return $item;
                                  }
                          });
                          $contentheads_anasayfa = $contentheads_anasayfa->first();
                        ?>
                        <!-- <h2>DİJİTAL SAĞLIK AJANSI</h2> -->
                        <h2>
                            {{ $contentheads_anasayfa->contenthead_title }}
                        </h2>
                    </div>
                    <div>
                        <!-- <p>Dijital medyanın doktoru DHA ile tedavi planınız hazır! <br><br>

                            DHA, dijital pazarlama ve dijital repütasyonun öneminin yadsınamadığı
                            günümüzde zaten işleri başından aşkın olan hekim ve kliniklerin
                            bu alana ayırmaları gereken zaman ve enerjilerini koruyabilmeleri amacıyla ortaya çıktı.
                            <br><br>

                            Siz bir çok yaşamı görünür kılarken, biz de sosyal
                            medya hesaplarınızı görünür yapıyoruz. DHA; doğru tedaviyle
                            markanızı iyileştir, çözüm üretir, yaratıcı fikirler geliştirir.
                            Siz muayenenize devam edin gerisini biz hallederiz! </p> -->
                        <P class="fs-sm">
                          <?php 
                             echo(nl2br($contentheads_anasayfa->contenthead_title_description));
                          ?>  
                        </P>    
                    </div>
                    <div><a href="/biz-kimiz"><button> DAHA FAZLASI</button></a></div>
                    <!-- <div><button>DAHA FAZLASI</button></div> -->
                </div>
            </section>
        </header>
        <section class="grid-container">
            <div class="container1"> 
                <?php
                  $contentheads_biz_kimiz = $contentheads->filter(function($item)
                      {
                          if($item->site_content_type->contenttype_slug == 'biz_kimiz')
                          {
                              return $item;
                          }
                  });
                  $contentheads_biz_kimiz = $contentheads_biz_kimiz->first();
                ?>
                <!-- <h1><span> Biz Kimiz?</span></h1> -->
                <h1><span> {{ $contentheads_biz_kimiz->contenthead_title }}</span></h1>
                <!-- <p>DHA, sadece sağlık sektörüne hizmet veren,
                    alanında uzman ekibiyle kurulan dijital sağlık ajansıdır.
                    Dijital pazarlama ve dijital repütasyonun öneminin
                    yadsınamadığı günümüzde zaten işleri başından aşkın
                    olan hekim ve kliniklerin bu alana ayırmaları gereken
                    zaman ve enerjilerini koruyabilmeleri amacıyla ortaya çıkmıştır.
                    Siz bir çok yaşamı görünür kılarken, biz de
                    sosyal medya hesaplarınızı görünür yapıyoruz.
                    DHA; doğru tedaviyle markanızı iyileştir, çözüm üretir,
                    yaratıcı fikirler geliştirir. Siz dünyayı iyileştirmeye devam edin gerisini biz hallederiz! 
                </p> -->
                <p class="fs-sm">
                  {{ $contentheads_biz_kimiz->contenthead_title_description }}
                </p>
            </div>
            <div class="container2">
                <?php
                $contentitems_biz_kimiz = $contentitems->filter(function($item)
                    {
                        if($item->site_content_type->contenttype_slug == 'biz_kimiz')
                        {
                            return $item;
                        }
                });
                ?>
                @foreach($contentitems_biz_kimiz as $contentitem)
                <div>
                    <div><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_logo_image_name	}}" alt=""></div>
                    <div>
                        <!-- <h1>DİJİTAL REKLAM YONETİMİ</h1> -->
                        <h1>{{ $contentitem->	contentitem_title }}</h1>
                    </div>
                    <div>
                        <!-- <p>Uzman grafiker ve editörlerimizle sosyal
                            medya hesabınızı analiz ediyor, ihtiyaca
                            uygun düzenliyor, büyütüyor ve raporluyoruz.
                        </p> -->
                        <p class="fs-sm">
                            {{ $contentitem->contentitem_title_description }}
                        </p>
                    </div>
                </div>
                @endforeach
                <!-- <div>
                    <div><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/2.png') }}" alt=""></div>
                    <div>
                        <h1>İÇERİK YONETİMİ VE YAZARLIGI</h1>
                    </div>
                    <div>
                        <p>Konusunda deneyimli metin yazarları ile
                            branşınıza uygun içerikler ve bloglar üretiyor,
                            SEO çalışmalarıyla isminizi arama motorlarında üst sıralara taşıyoruz.

                        </p>
                    </div>
                </div>
                <div>
                    <div><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/3.png') }}" alt=""></div>
                    <div>
                        <h1>REPUTASYON YONETİMİ</h1>
                    </div>
                    <div>
                        <p>Dijital medyadaki kimlikleriniz; sosyal medya
                            hesaplarınız ve web sitenizi sizi en iyi yansıtacak
                            duruma getiriyoruz, bilinirlik ve güvenilirliğinizi ön plana çıkartıyoruz.
                        </p>
                    </div>
                </div>
                <div>
                    <div><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/4.png') }}" alt=""></div>
                    <div>
                        <h1>PRODUKSİYON</h1>
                    </div>
                    <div>
                        <p>Söz uçar, görüntü kalır! Alanınızda röportaj,
                            bilgi paylaşımı ve tanıtım filmleri hazırlıyor,
                            tanınırlığınızı besliyoruz.
                        </p>
                    </div>
                </div> -->
            </div>
        </section>
        <section class="works-container">
            <div class="works-1">
                <div><img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/Vector Smart Object.png') }}" alt=""></div>
                <div>
                    <?php
                      $contentheads_islerimiz = $contentheads->filter(function($item)
                          {
                              if($item->site_content_type->contenttype_slug == 'islerimiz')
                              {
                                  return $item;
                              }
                      });
                      $contentheads_islerimiz = $contentheads_islerimiz->first();
                    ?>
                    <!-- <h1><span>İşlerimiz</span></h1> -->
                    <h1><span> {{ $contentheads_islerimiz->contenthead_title }}</span></h1>
                </div>
                <div>
                    <!-- <p>Lorem ipsum dolor sit Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam pariatur
                        reiciendis in nihil magni est ad corporis sapiente consectetur ea!amet consectetur, adipisicing
                        elit. Est, aut?
                    </p> -->
                    <p class="fs-sm">
                      <?php 
                      echo(nl2br($contentheads_islerimiz->contenthead_title_description));
                      ?>  
                    </p>
                </div>
            </div>
            <div class="works-2">
                <ul>
                    <?php
                    $i=1;
                    ?>
                    <li><a class="btn active2" data-filter="all" href="">HEPSI</a></li>
                    <li></li>
                    @foreach($filters as $filter)
                      <li><a class="btn" data-filter="{{ $filter->filter_slug }}" href="#">{{ $filter->filter_name }}</a></li>
                      @if($i < $filters_count)
                      <li></li>
                      @endif
                      <?php $i=$i+1; ?>
                    @endforeach

                    <!-- 
                    <li><a class="btn active" data-filter="grid-item" href="">HEPSI</a></li>
                    <li></li>
                    <li><a class="btn" data-filter="graphic" href="##">GRAPHIC</a></li>
                    <li></li>
                    <li><a class="btn" data-filter="web" href="#">WEB DESIGN</a></li>
                    <li></li>
                    <li><a class="btn" data-filter="logo" href="">LOGO</a></li>
                    <li></li>
                    <li><a class="btn" data-filter="branding1" href="">BRANDING</a></li>
                    <li></li>
                    <li><a class="btn" data-filter="digital1" href="">DIGITAL</a></li> -->
                </ul>
            </div>
            <div class="works-3">
                <!-- <div class="grid-item item1 all" data-filter="all">1</div>
                <div class="grid-item item2 all" data-filter="all">2</div> -->
                <?php
                    $contentitems_islerimiz = $contentitems->filter(function($item)
                        {
                            if($item->site_content_type->contenttype_slug == 'islerimiz')
                            {
                                return $item;
                            }
                    });
                ?>
                <?php
                $i=1;
                ?>
                @foreach($contentitems_islerimiz as $iş)
                  <div class="grid-item item{{ $i }} all {{ $iş->filter->filter_slug }}">
                    <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $iş->contentitem_image_name	}}" alt="">
                  </div>
                  <?php $i=$i+1; ?>
                @endforeach
                @for($i ;$i<=8; $i++)
                  <div class="grid-item item{{ $i }} all {{ $i }}">
                    <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $iş->contentitem_image_name	}}" alt="">
                  </div>
                @endfor
                <!-- 
                <div class="grid-item  branding"><img src="./dha-images/dijitalrecete1.jpg" alt=""></div>
                <div class="grid-item  digital1"><img src="./dha-images/dijitalrecete1.jpg" alt="">2</div>
                <div class="grid-item  graphic"><img src="" alt="">3</div>
                <div class="grid-item  web"><img src="" alt="">4</div>
                <div class="grid-item  logo web"><img src="" alt="">5</div>
                <div class="grid-item  logo"><img src="" alt="">6</div>
                <div class="grid-item  branding"><img src="" alt="">7</div>
                <div class="grid-item  digital1"><img src="" alt="">8</div>
                -->
            </div>
        </section>


        <section class="digital-pros">
            <div class="digital">
                <?php
                  $contentheads_recetemiz = $contentheads->filter(function($item)
                      {
                          if($item->site_content_type->contenttype_slug == 'dijital-recetemiz')
                          {
                              return $item;
                          }
                  });
                  $contentheads_recetemiz = $contentheads_recetemiz->first();
                ?>
                <div>
                    <h1><span> {{ $contentheads_recetemiz->contenthead_title }} </span></h1>
                </div>
                <div>
                <p>
                  <?php 
                  echo(nl2br($contentheads_recetemiz->contenthead_title_description));
                  ?>  
                  <img src="{{ asset(Config::get('constants.frontend_address').'/dha-images/Vector Smart Object3.png') }}" alt="">
                </p>
                </div>
            </div>
            <div class="digital-slider">
                <div class="swiper-wrapper">
                    <?php
                    $contentitems_recetemiz = $contentitems->filter(function($item)
                        {
                            if($item->site_content_type->contenttype_slug == 'dijital-recetemiz')
                            {
                                return $item;
                            }
                    });
                    ?>
                    @foreach($contentitems_recetemiz as $contentitem)
                    <div class="swiper-slide">
                        <span>
                            <div>
                                <h4>{{ $contentitem->contentitem_title }}</h4>
                            </div>
                            <div>
                                  <h5>
                                    <?php 
                                      echo(nl2br($contentitem->contentitem_title_description));
                                    ?>  
                                  </h5>  
                            </div>
                            <div class="vertical-line"></div>
                            <div>
                                <p>
                                  <?php 
                                      echo(nl2br($contentitem->contentitem_description));
                                    ?>  
                                </p>
                            </div>
                        </span>
                    </div>
                    @endforeach
                    <!-- <div class="swiper-slide">
                        <span>
                            <div>
                                <h5>GOOGLE ADS & SEO</h5>
                            </div>
                            <div>
                                <h6>Arama motoru optimizasyonu, dijital
                                    bilirliğin artması</h6>
                            </div>
                            <div class="vertical-line"></div>
                            <div>
                                <p>Markanızın arama motorlarında daha
                                    üst sıralarda çıkmasını sağlıyor,
                                    dijital repütasyonunuzu yükseltiyoruz.
                                </p>
                            </div>
                        </span>
                    </div>

                    <div class="swiper-slide">
                        <span>
                            <div>
                                <h5>FOTOGRAF & VİDEO</h5>
                            </div>
                            <div>
                                <h6>Konsept fotoğraf ve video çekimler </h6>
                            </div>
                            <div class="vertical-line"></div>
                            <div>
                                <p>Profesyonel makine ve uzman ekibimizle
                                    muayenehane, hastane, poliklinik ve
                                    ameliyathane çekimleri yapıyor,
                                    hastalarınızın sizi görmesini sağlıyoruz.
                                    Youtube kanalınıza yüklenmesi
                                    işlemlerini yapıyoruz.
                                </p>
                            </div>
                        </span>
                    </div>

                    <div class="swiper-slide">
                        <span>
                            <div>
                                <h5>FOTOGRAF & VİDEO</h5>
                            </div>
                            <div>
                                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus, ab!</h6>
                            </div>
                            <div class="vertical-line"></div>
                            <div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Cumque itaque laudantiu
                                    m possimus quaerat veritatis nobis? Iure qui eveniet
                                    minus consequuntur iste ducimus vel, sequi impedit!
                                </p>
                            </div>
                        </span>
                    </div>

                    <div class="swiper-slide">
                        <span>
                            <div>
                                <h5>FOTOGRAF & VİDEO</h5>
                            </div>
                            <div>
                                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus, ab!</h6>
                            </div>
                            <div class="vertical-line"></div>
                            <div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Cumque itaque laudantiu
                                    m possimus quaerat veritatis nobis? Iure qui eveniet
                                    minus consequuntur iste ducimus vel, sequi impedit!
                                </p>
                            </div>
                        </span>
                    </div> -->

                </div>
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>


            </div>
        </section>
        <section class="blog">
            <div class="blog-header">
                <?php
                  $contentheads_blog = $contentheads->filter(function($item)
                      {
                          if($item->site_content_type->contenttype_slug == 'blog')
                          {
                              return $item;
                          }
                  });
                  $contentheads_blog = $contentheads_blog->first();
                ?>
                <div>
                    <h1><span>{{ isset($contentheads_blog->contenthead_title) ? $contentheads_blog->contenthead_title : 'Blog' }}</span></h1>
                </div>
                <div>
                    <h4>{{ isset($contentheads_blog->contenthead_title_description) ? $contentheads_blog->contenthead_title_description : '' }}</h4>
                </div>
            </div>
            <div class="blog-slider">
                <div class="swiper-wrapper">
                    <?php
                        $contentitems_blogs = $contentitems->filter(function($item)
                            {
                                if($item->site_content_type->contenttype_slug == 'blog')
                                {
                                    return $item;
                                }
                        }); 
                    ?> 
                    @foreach($contentitems_blogs as $contentitem)
                        <div class="swiper-slide">
                            <div class="swipe">
                                <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt="">
                                <a href="{{ URL::to('/') }}/blog/{{ isset($contentitem->contentitem_slug) ? $contentitem->contentitem_slug : '' }}">
                                <div class="swipe-content">
                                    <div class="date">
                                        <h5>{{ isset($contentitem->contentitem_title) ? $contentitem->contentitem_title : '' }}</h5>
                                    </div>
                                    <div>
                                        <p>
                                        <?php  
                                            if(isset($contentitem->contentitem_title_description)) { $blog_text = $contentitem->contentitem_title_description; } else  { $blog_text = '';};
                                            $blog_text = substr($blog_text,0,100);
                                        ?>
                                        {{ $blog_text }}
                                        </p>
                                    </div>
                                    <div><i class="fas fa-angle-right fa-lg"></i></div>
                                </div>
                            </div>
                        </div>
                    @endforeach    

                    <!-- <div class="swiper-slide">
                        <div class="swipe">
                            <img src="./dha-images/dijitalrecete1.jpg" alt="">
                            <a href="./pages/blogs/ads-seo.html">
                                <div class="swipe-content">
                                    <div class="date">
                                        <h5> 17 temmuz 2019</h5>
                                    </div>
                                    <div>
                                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                                    </div>
                                    <div><i class="fas fa-angle-right fa-lg"></i></div>
                                </div>
                            </a>
                        </div>
                    </div> -->

                </div>
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-p"><i class="fas fa-angle-left fa-lg"></i></div>
                <div class="swiper-button-n"><i class="fas fa-angle-right fa-lg"></i></div>


            </div>

        </section>

        <section class="refer">
            <div class="refer-header">
                <?php
                  $contentheads_referanslar = $contentheads->filter(function($item)
                  {
                          if($item->site_content_type->contenttype_slug == 'referenslar')
                          {
                              return $item;
                          }
                  });
                  $contentheads_referanslar = $contentheads_referanslar->first();
                ?>
                <h1><span>{{ $contentheads_referanslar->contenthead_title }}</span></h1>
            </div>
            <div class="ref-slider">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                        $contentheads_referanslar = $contentitems->filter(function($item)
                            {
                                if($item->site_content_type->contenttype_slug == 'referenslar')
                                {
                                    return $item;
                                }
                        });
                    ?> 
                    @foreach($contentheads_referanslar as $contentitem)                    
                        <div class="swiper-slide"><a href="{{ $contentitem->contentitem_url }}"><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt=""></a></div>
                    @endforeach
                    <!-- <div class="swiper-slide"><img src="" alt=""></div>
                    <div class="swiper-slide"><img src="" alt=""></div>
                    <div class="swiper-slide"><img src="" alt=""></div>
                    <div class="swiper-slide"><img src="" alt=""></div>
                    <div class="swiper-slide"><img src="" alt=""></div> -->
                    ...
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>

@endsection