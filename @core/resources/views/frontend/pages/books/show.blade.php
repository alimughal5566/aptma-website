@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:url" content="{{route('frontend.services.single',$service_item->id)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$service_item->title}}"/>
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('meta-tags')
    <meta name="description" content="{{$service_item->meta_description}}">
    <meta name="tags" content="{{$service_item->meta_tag}}">
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('site-title')
    {{$service_item->title}} -  {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{$service_item->title}}
@endsection
@section('content')

    <div class="page-content service-details common-single book-single padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="common-single-title book-single-title margin-bottom-15">{{$service_item->title}}</h3>
                </div>

                <div class="col-lg-6">
                    <div class="service-details-item common-single-item book-single-item position-relative">
                        <a href="{{asset('assets/uploads/books/'.$service_item->url)}}" download class="btn">Download</a>
                        <div class="thumb margin-bottom-40">
                            {!! render_image_markup_by_attachment_id($service_item->thumbnail) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-details-item common-single-item book-single-item position-relative">
                        <div class="service-description common-single-description book-description">
                            <div><strong>Category:</strong> {{$service_item->category->name}}</div>
                            <div>{!! $service_item->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
