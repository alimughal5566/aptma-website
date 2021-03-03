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


    <div class="page-content service-details economic-single economic-single padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="economic-single-title-wrap d-flex align-items-center justify-content-between">
                        <h3 class="common-single-title economic-single-title mb-0">{{$service_item->title}}</h3>
                        <a href="{{asset('assets/uploads/daily-economics/'.$service_item->url)}}" download
                           class="btn">Download</a>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="service-details-item common-single-item economic-single-item position-relative">
                        <embed type="application/pdf" frameborder="0" scrolling="no" showcontrols="false"
                               src="{{asset('assets/uploads/daily-economics/'.$service_item->url.'#embedded=true&page=1&toolbar=0&navpanes=0&scrollbar=0&view=fitH,100&zoom=100&view=Fit')}}"
                               height="800px" width="100%"/>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

