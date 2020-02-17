@extends('layouts.siteLayouts.site_main')

@section('content')
 
    <div class="refheader"><h1>{{ $contentheads->contenthead_title }}</h1></div>
        <section class="refcontainer">
            <!-- <div class="refsample"><div><a href="https://www.google.com"></a></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div>
            <div class="refsample"><div></div><h5>digital heat agency</h5></div> -->
            @foreach($contentitems as $contentitem)
                <div class="refsample"><div>
                  <a href="{{ $contentitem->contentitem_url }}">
                    <div><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt=""></div>
                  </a>
                </div>
                  <h5>
                  {{ $contentitem->contentitem_title }}
                  </h5>
                </div>
            @endforeach    
        </section>


@endsection

