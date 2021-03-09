@extends('frontend.frontend-page-master')
@section('og-meta')
    {{--    <meta property="og:url" content="{{route('frontend.services.single',$service_item->id)}}"/>--}}
    {{--    <meta property="og:type" content="article"/>--}}
    {{--    <meta property="og:title" content="{{$service_item->title}}"/>--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection

@section('meta-tags')
    {{--    <meta name="description" content="{{$service_item->meta_description}}">--}}
    {{--    <meta name="tags" content="{{$service_item->meta_tag}}">--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection

@section('site-title','Daily Exchange Rates')

<style>
    .common-single .common-single-item.exchange-rate-single-item .table-responsive .table thead th {
        min-width: 115px;
    }

    .common-single .common-single-item.exchange-rate-single-item .table-responsive .table thead th:first-child {
        min-width: 35px;
    }
</style>

@section('content')
    <div class="page-content service-details common-single exchange-rate-single padding-top-50 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-details-item common-single-item exchange-rate-single-item position-relative">

                        <div class="d-flex flex-column align-items-center justify-content-lg-between flex-lg-row mb-3">
                            <h2 class="common-single-title exchange-rate-single-title mb-0">Statistics
                            {{--                                <span>{{Carbon\Carbon::parse($date)->format('d M Y')}}</span></h2>--}}
                            {{--                            <a class="btn" href="{{route('frontend.export.excel.exchange-rates',['date'=>$date])}}">Download</a>--}}
                        </div>
                        @php $a = 1; @endphp
                        {{--                        {{dd($category_data->sheet_data[3])}}--}}
                        @isset($category_data->sheet_data[0])
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>{{$category_data->sheet_data[0][0]}}</span>
                                    {{--                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>--}}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        @foreach($category_data->sheet_data[2] as $key=> $data)
                                            <th scope="col">{{$data}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category_data->sheet_data as $key=>$data)

                                        @if($key>2)
{{--                                            {{dd($data)}}--}}
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @foreach($data as $d)
                                                    <td>{{$d}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--                                {!! $month_wise->render() !!}--}}
                            </div>
                        @endisset
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
