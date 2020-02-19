@extends('layouts.siteLayouts.site_main')

@section('content')

        <div class="work-sample-header">
            <h1>{{ $contentheads->contenthead_title }}</h1>
        </div>
        <div class="work-sample">
            <ul>
                <!-- 
                <li><a href="" data-filter2="all2" class="btn2 active2">ALL</a></li>
                <li></li>
                <li><a href="" data-filter2="graphic2" class="btn2">GRAPHİC</a></li>
                <li></li>
                <li><a href="" data-filter2="web2" class="btn2">WEB</a></li>
                <li></li>
                <li><a href="" data-filter2="logo2" class="btn2">LOGO</a></li>
                <li></li>
                <li><a href="" data-filter2="branding2" class="btn2">BRANDİNG</a></li>
                <li></li>
                <li><a href="" data-filter2="digital2" class="btn2">DİGİTAL</a></li> 
                -->
                <?php
                $i=1;
                ?>
                <li><a class="btn2 active2" data-filter2="all2" href="">HEPSI</a></li>
                <li></li>
                @foreach($filters as $filter)
                  <li><a class="btn2" data-filter2="{{ $filter->filter_slug }}" href="">{{ $filter->filter_name }}</a></li>
                  @if($i < $filters_count)
                  <li></li>
                  @endif
                  <?php $i=$i+1; ?>
                @endforeach

            </ul>
        </div>
        <div class="work-sample-2">
        @foreach($contentitems as $contentitem)
            <?php
                $filter = isset($contentitem->filter->filter_name) ? $contentitem->filter->filter_name : '';
                // echo('<br>');
                // echo("grid-list all2 " . $filter );
            ?>
            <div class="grid-list all2 {{ $filter }}">
               <div class="flipinner">
                   <div class="flipfront">
                       <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt="">
                   </div>
                   <a href="{{isset($contentitem->contentitem_url) ? $contentitem->contentitem_url : ''}}">  
                   <div class="flipback">
                    <div>
                      <p>
                        {{ $contentitem->contentitem_title_description }}
                      </p>
                    </div>
                   </div>
               </div>
            </div>
        @endforeach    
  
            <!-- 
            <div class="grid-list all2 digital2">
                <div class="flipinner">
                    <div class="flipfront"><img src="../dha-images/dijitalrecete1.jpg" alt=""></div>
                    <a href="">
                        <div class="flipback">
                            <div>
                                <p>Profesyonel makine ve uzman ekibimizle
                                    muayenehane, hastane, poliklinik ve ameliyathane çekimleri yapıyor,
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            ...
            -->
          </div>

@endsection