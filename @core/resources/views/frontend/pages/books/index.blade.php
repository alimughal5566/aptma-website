@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    Videos
@endsection
@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section class="service-area service-page common-area book-area book-page padding-top-40 padding-bottom-60">
        <h2 class="font-weight-bold mb-3 text-center">Books<?php echo ($category)? "<small>($category)<small>":"" ?></h2>

        <div class="container">
            <div class="row">

                @forelse($all_services as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="common-item book-item single-what-we-cover-item-02 margin-bottom-30">
                            <div class="common-img book-img single-what-img position-relative">
                                @php
                                    $now = Carbon\Carbon::now();
                                $datework = Carbon\Carbon::parse($data->created_at);
                                $diff = $datework->diffInDays($now); @endphp
                                @if($diff<15)
                                    <small class=" font-italic badge">New</small>
                                @endif

                                <a href="{{route('frontend.book.single',$data->id)}}">
                                    {!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>
                            </div>
                            <div class="common-content content">
                                <a href="{{route('frontend.book.single',$data->id)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <p><strong>Category:</strong> {{@$data->category->name}}</p>
                                <a href="{{asset('assets/uploads/books/'.$data->url)}}"
                                   class="btn">Download</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 card border-0 thumb margin-bottom-40">
                        <div class="text center px-5 card-body ">
                            <h1 class="text-muted">Sorry,No data found</h1>
                        </div>
                    </div>
                @endforelse
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_services->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
