@extends('frontend.frontend-page-master')
@section('site-title','Statistics')

@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section
            class="service-area service-page common-area publication-area publication-page padding-top-40 padding-bottom-60">
        <div class="container">
            {{--            <div class="row">--}}
            {{--                <div class="col-12 col-md-9">--}}
            {{--                    <h2 class="font-weight-bold text-center">Daily Exchange Rates</h2>--}}
            {{--                </div>--}}
            {{--                <div class="col-12 col-md-3">--}}
            {{--                    <div>--}}
            {{--                        <label for="search_date" class="sr-only"></label>--}}
            {{--                        <select class="form-control" onchange="searchRecord()" name="search_date" id="search_date">--}}
            {{--                            <option value="">Search with date</option>--}}
            {{--                            @isset($all_dates)--}}
            {{--                                @foreach( $all_dates as $date)--}}
            {{--                                    <option value="{{$date->date}}">{{$date->date}}</option>--}}
            {{--                                @endforeach--}}
            {{--                            @endisset--}}
            {{--                        </select>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row">
                @php $a = 1; @endphp

                <div class="col-lg-3 col-md-6">
                    <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                        <div class="common-content content">
                            <p class="">
                                <span>Month Wise District Wise</span>
                            </p>
                            <a href="{{route('frontend.statistics.get.table',['type'=>'month_wise_district_wise'])}}"
                               class="btn text-center">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                        <div class="common-content content">
                            <p class="">
                                <span>Global Impact</span>
                            </p>
                            <a href="{{route('frontend.statistics.get.table',['type'=>'global_impact'])}}"
                               class="btn text-center">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                        <div class="common-content content">
                            <p class="">
                                <span>Product Export &amp; Domestic Re</span>
                            </p>
                            <a href="{{route('frontend.statistics.get.table',['type'=>'production_export'])}}"
                               class="btn text-center">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                        <div class="common-content content">
                            <p class="">
                                <span>Export Of Raw Cotton</span>
                            </p>
                            <a href="{{route('frontend.statistics.get.table',['type'=>'export_of_raw_cotton'])}}"
                               class="btn text-center">View</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
@push('after-script')
    <script>
        function searchRecord() {
            let date = $('#search_date').val();
            let route = '{{route('frontend.daily.stats.with.date',':date')}}';
            route = route.replace(':date', date)
            $.ajax({
                url: route,
                success: function (result) {
                    window.location.href = route;
                }, fail: function () {
                    alert('No record found')
                }
            })
        }
    </script>

@endpush