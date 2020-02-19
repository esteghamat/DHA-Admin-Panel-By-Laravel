@extends('layouts.siteLayouts.site_main')

@section('content')
 
    <div class="refheader"><h1>{{ $contentheads->contenthead_title }}</h1></div>
        <section class="refcontainer">
            <!-- 
            <div class="refsample">
                <div>
                  <img src="/dha-images/dijitalrecete1.jpg" alt="">
                  <span><a href=""><i class="fas fa-external-link-alt fa-4x"></i></span>
                  </a>
                </div>
                <h5>digital heat agency</h5>
            </div>

             -->
            @foreach($contentitems as $contentitem)
                <div class="refsample">
                  <div>
                    <img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt="">
                    <span>
                      <a href="{{ $contentitem->contentitem_url }}"><i class="fas fa-external-link-alt fa-4x"></i>
                      </a>
                    </span>
                  </div>  
                  <h5>
                  {{ $contentitem->contentitem_title }}
                  </h5>
                </div>
            @endforeach    
        </section>


@endsection

