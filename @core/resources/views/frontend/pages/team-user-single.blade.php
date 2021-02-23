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
@section('site-title',$data->name)
@section('content')
    <div class="page-content service-details common-single team-single padding-top-50 ">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <h2 class="common-single-title team-single-title margin-bottom-15">{{$data->name}}</h2>
                </div>
                <div class="col-12 col-lg-6 pb-lg-5">
                    <div class="service-details-item common-single-item team-single-item position-relative">
                        <div class="thumb mb-3">
                            {!! render_image_markup_by_attachment_id($data->image) !!}
                        </div>
                        <h5 class="d-flex flex-column">
                            <span>Designation:</span>
                            <span class="text-dark">{{$data->designation}}</span>
                        </h5>
                        <h5 class="d-flex flex-column py-2">
                            <span>Department:</span>
                            <span class="text-dark">{{$data->department->name}}</span>
                        </h5>
                        <div class="social-link pb-4">
                            <ul>
                                @if(!empty( $data->icon_one) && !empty( $data->icon_one_url))
                                    <li>
                                        <a target="_blank" href="{{ $data->icon_one_url}}">
                                            <i class="{{ $data->icon_one}}"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty( $data->icon_two) && !empty( $data->icon_two_url))
                                    <li>
                                        <a target="_blank" href="{{ $data->icon_two_url}}">
                                            <i class="{{ $data->icon_two}}"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty( $data->icon_three) && !empty( $data->icon_three_url))
                                    <li>
                                        <a target="_blank" href="{{ $data->icon_three_url}}">
                                            <i class="{{ $data->icon_three}}"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pb-5 pb-lg-5">
                    <div class="service-details-item common-single-item team-single-item position-relative">
                        {{--                        <div class="service-description team-about">--}}
                        {{--                            <strong>About me:</strong>--}}
                        {{--                            <div>{!! $data->about_me !!}</div>--}}
                        {{--                        </div>--}}
                        <div class="service-description team-description">
                            <h5>Description:</h5>
                            <div>{!! $data->description !!}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
