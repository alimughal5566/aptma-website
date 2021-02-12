@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    Circulars
@endsection
@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section class="service-area service-page common-area circular-area circular-page padding-top-40 padding-bottom-60">
        <div class="container">
            <div class="row">
                @php $a = 1; @endphp
                @foreach($all_services as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="common-item circular-item single-what-we-cover-item-02 margin-bottom-30">
                            <div class="common-img circular-img single-what-img position-relative">
                                @php
                                    $now = Carbon\Carbon::now();
                                $datework = Carbon\Carbon::parse($data->created_at);
                                $diff = $datework->diffInDays($now);
                                @endphp
                                @if($diff<15)
                                    <small class="font-italic badge">New</small>
                                @endif

                                <a href="{{route('frontend.circular.single',$data->id)}}">{!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>
                            </div>
                            <div class="common-content content">
                                <a href="{{route('frontend.circular.single',$data->id)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <p>Category: {{@$data->category->name}}</p>
                                <p>Last updated: {{@$data->updated_at->format('d M Y')}}</p>
                                <a href="{{asset('assets/uploads/circular/'.$data->url)}}" target="_blank"
                                   class="btn text-center">Download</a>
                            </div>
                        </div>
                    </div>
                    @php
                        if($a == 4){ $a = 1;}else{$a++;};
                    @endphp
                @endforeach
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_services->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
