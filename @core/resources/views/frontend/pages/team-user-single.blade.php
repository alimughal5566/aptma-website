@extends('frontend.frontend-page-master')
@section('og-meta')
    {{--    <meta property="og:url" content="{{route('frontend.services.single',$service_item->id)}}"/>--}}
    <meta property="og:type" content="article"/>
    {{--    <meta property="og:title" content="{{$service_item->title}}"/>--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection
@section('meta-tags')
    {{--    <meta name="description" content="{{$service_item->meta_description}}">--}}
    {{--    <meta name="tags" content="{{$service_item->meta_tag}}">--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection
@section('site-title')
    {{$data->title}}
@endsection
@section('page-title')
    {{$data->title}}
@endsection
@section('content')

    <div class="page-content service-details common-single team-single padding-top-50 padding-bottom-100 ">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <h3 class="common-single-title team-single-title margin-bottom-15">{{$data->name}}</h3>
                </div>
                <div class="col-lg-6 pb-5">
                    <div class="service-details-item common-single-item team-single-item position-relative">
                        <h5>Designation: <strong>{{$data->designation}}</strong></h5>
                        <h5>Department: <strong>{{$data->department->name}}</strong></h5>
                        <div class="social-link pb-5">
                            <ul>
                                @if(!empty( $data->icon_one) && !empty( $data->icon_one_url))
                                    <li>
                                        <a href="{{ $data->icon_one_url}}">
                                            <i class="{{ $data->icon_one}}"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty( $data->icon_two) && !empty( $data->icon_two_url))
                                    <li>
                                        <a href="{{ $data->icon_two_url}}">
                                            <i class="{{ $data->icon_two}}"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty( $data->icon_three) && !empty( $data->icon_three_url))
                                    <li>
                                        <a href="{{ $data->icon_three_url}}">
                                            <i class="{{ $data->icon_three}}"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($data->image) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="service-details-item common-single-item team-single-item position-relative">

                        <div class="service-description team-about">
                            <strong>About me:</strong>
                            <div>{!! $data->about_me !!}</div>
                        </div>
                        <div class="service-description team-description">
                            <strong>About me:</strong>
                            <div>{!! $data->description !!}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
