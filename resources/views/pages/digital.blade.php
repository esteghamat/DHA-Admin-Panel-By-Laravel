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

@endsection
