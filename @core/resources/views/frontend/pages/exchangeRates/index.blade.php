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
            <div>
                <h2 class="font-weight-bold mb-3 text-center">Daily Exchange Rates</h2>
                <div>
                    <select class="form-control" onchange="searchRecord()" name="search_date" id="search_date">
                        <option value="" >Search with date</option>
                        @foreach($dates as $date)
                            <option value="{{$date->date}}">{{$date->date}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                @php $a = 1; @endphp
                {{--                {{dd($dates)}}--}}
                @if(isset($dates[0]))
                    @foreach($dates  as $date)
                        <div class="col-lg-3 col-md-6">
                            <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                                <div class="common-content content">
                                    <p class="">
                                        <span>{{date('M d Y', strtotime(@$date->date))}}</span>
                                    </p>
                                    <a href="{{route('frontend.view.excel.record',['date'=>$date->date])}}"
                                       class="btn text-center">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
@push('after-script')
    <script>
        function searchRecord() {
            let date= $('#search_date').val();
            let route = '{{route('frontend.daily.stats.with.date',':date')}}';
            route = route.replace(':date',date)
            $.ajax({
                url: route,
                success:function (result) {
                    window.location.href = route;
                },fail:function () {
                    alert('No record found')
                }
            })
        }
    </script>

@endpush