@extends('layouts.siteLayouts.site_main')

@section('content')

<?php
    $contentitems_selected_blog = $contentitems->filter(function($item) use($blog_slug)
        {
            if($item->contentitem_slug == $blog_slug )
            {
                return $item;
            }
    });
    $contentitems_selected_blog = $contentitems_selected_blog->first();
?>


<div class="blog-head-image"><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitems_selected_blog->contentitem_image_name	}}" alt=""></div>

        <section class="blog-content">
            <div class="blog-content-left">
                <div>
                    <h1>{{ $contentitems_selected_blog->contentitem_title }}</h1>
                </div>
                <div>
                    <p>
                        {{ $contentitems_selected_blog->contentitem_description }}
                    </p>
                </div>
            </div>
            <div class="blog-content-right">
                <div class="right-header">
                    <h3>Diger Bloglar</h3>
                </div>
                <div class="right-content">
                @foreach($contentitems as $contentitem)  
                    <div>
                        <div><img src="{{ URL::to('/') }}/{{Config::get('constants.backend_address')}}/uploaded_files/images/{{ $contentitem->contentitem_image_name	}}" alt=""></div>
                        <div><a href="/blog/{{ $contentitem->contentitem_slug }}">{{ $contentitem->contentitem_title }}</a></div>
                    </div>
                @endforeach
                <div class="right-sm">
                    <div>
                        <h5>Sosyal Medya</h5>
                    </div>
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                    <a href=""><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </section>
        <div>

@endsection