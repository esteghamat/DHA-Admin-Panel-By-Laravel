@extends('layouts.siteLayouts.site_main')

@section('content')

    <div class="blog-page-header"><h1>{{ $contentheads->contenthead_title }}</h1></div>
        <section class="blog-body">
        @foreach($contentitems as $contentitem)
            <div class="blog-body-content">
                <div><img src="{{ URL::to('/') }}/backend_assets/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt=""></div>
                <div><h1>{{ $contentitem->contentitem_title }}</h1>
                    <p>
                        {{ $contentitem->contentitem_title_description }}
                    </p>
                    <br>
                    <a href="/blog/blogdetails/{{ $contentitem->contentitem_slug }}">Devamını Oku   <i class="fas fa-long-arrow-alt-right fa-sm"></i></a>
                    {{-- <a href="{{ url('blog/blogdetails/$contentitem->contentitem_slug') }}">Devamını Oku   <i class="fas fa-long-arrow-alt-right fa-sm"></i></a> --}}
                </div>
            </div>
        @endforeach    
        </section>

@endsection