@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    Videos
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section class="service-area service-page padding-120">
        <div class="container">
            <div class="row">
                @php $a = 1; @endphp
                @foreach($all_services as$data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-what-we-cover-item-02 margin-bottom-30">
                            <div class="single-what-img "  style="max-height: 50%;">
                                <a href="{{$data->url}}" target="_blank">
                                {!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>
                            </div>
                            <div class="content">
                                <p>Category:{{@$data->category->name}}</p>
                               <a href="{{route('frontend.book.single',$data->id)}}" target="_blank"><h4 class="title">{{$data->title}}</h4></a>
                                @php
                                    $now = Carbon\Carbon::now();
                                $datework = Carbon\Carbon::parse($data->created_at);
                                $diff = $datework->diffInDays($now); @endphp
                                @if($diff<15)
                                <small class="float-right text-danger font-italic badge badge-warning" >New</small>
                                @endif
                                <a href="{{asset('assets/uploads/books/'.$data->url)}}" class="float-right text-right pr-1"  download>download</a>
                            </div>
                        </div>
                    </div>
                    @php
                        if($a == 4){ $a = 1;}else{$a++;}; @endphp
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
