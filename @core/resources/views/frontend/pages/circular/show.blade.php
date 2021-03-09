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

    <div class="page-content service-details common-single circular-single padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="common-single-title circular-single-title margin-bottom-15">{{$service_item->title}}</h3>
                </div>

                <div class="col-lg-6">
                    <div class="service-details-item common-single-item circular-single-item position-relative">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($service_item->thumbnail) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-details-item common-single-item circular-single-item position-relative">
                        <div class="d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-lg-center">
                            <div class="service-meta">
                                <h4 class="mb-2 font-weight-bold">{{$service_item->category->name}}</h4>
                                <p>{{@$data->publish_date}}</p>
                            </div>
                            <a href="{{asset('assets/uploads/circular/'.$service_item->url)}}"
                               class="btn">Download</a>
                        </div>

                        <div class="service-description common-single-description circular-description">
                            <p>{!! $service_item->description !!}</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
