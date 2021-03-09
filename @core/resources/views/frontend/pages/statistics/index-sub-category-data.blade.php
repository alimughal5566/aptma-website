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

            <div class="row">
                @php $a = 1; @endphp
                @isset($category_data)
                    @foreach($category_data as $data)
                        <div class="col-lg-3 col-md-6">
                            <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                                <div class="common-content content">
                                    <p class="">
                                        @isset($data->getSubCategory)
                                            <span>{{$data->getSubCategory->title}}</span>
                                        @endisset
                                    </p>
                                    <a href="{{route('frontend.statistics.get.statistics.data',['id'=>$data->id])}}"
                                       class="btn text-center">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
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