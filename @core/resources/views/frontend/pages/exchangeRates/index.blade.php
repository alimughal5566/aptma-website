@extends('frontend.frontend-page-master')
@section('site-title','Daily Exchange Rates')

@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section
            class="service-area service-page common-area daily-exchange-area daily-exchange-page padding-120">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <h2 class="font-weight-bold text-center">Daily Exchange Rates</h2>
                </div>
                <div class="col-12 col-md-3 align-self-center">
                    <div>
                        <label for="search_date" class="sr-only"></label>
                        <select class="form-control" onchange="searchRecord()" name="search_date" id="search_date">
                            <option value="">Search with date</option>
                            @isset($all_dates)
                                @foreach( $all_dates as $date)
                                    <option value="{{$date->date}}">{{$date->date}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a = 1; @endphp
                @if(isset($dates[0]))
                    @foreach($dates  as $date)
                        <div class="col-lg-3 col-md-6">
                            <div class="common-item daily-exchange-item single-what-we-cover-item-02 margin-bottom-30">
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