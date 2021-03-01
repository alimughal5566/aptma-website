@extends('frontend.frontend-page-master')
@section('site-title','Daily Exchange Rates')

@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section
            class="service-area service-page common-area publication-area publication-page padding-top-40 padding-bottom-60">
        <div class="container">
            <h2 class="font-weight-bold mb-3 text-center">
                Daily Exchange Rates </h2>
            <div class="row">
                @php $a = 1; @endphp
                {{--                {{dd($dates)}}--}}
                @if(isset($dates[0]))
                    @foreach($dates  as $date)
                        <div class="col-lg-3 col-md-6">
                            <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                                <div class="common-content content">
                                    <p class="">
                                        <span>{{$date->date}}</span>
                                    </p>
                                    <a href="{{route('frontend.view.excel.record',['date'=>$date->date])}}"
                                       class="btn text-center">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
{{--                <div class="col-lg-12">--}}
{{--                    <div class="pagination-wrapper">--}}
{{--                        --}}{{--                        {{$all_services->links()}}--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
@endsection
