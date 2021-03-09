@extends('frontend.frontend-page-master')
@section('og-meta') @endsection

@section('meta-tags')   @endsection

@section('site-title', 'Statistics')

<style>
    .common-single .common-single-item.exchange-rate-single-item .table-responsive .table thead th {
        min-width: 115px;
    }
    .common-single .common-single-item.exchange-rate-single-item .table-responsive .table thead th:first-child {
        min-width: 35px;
    }
</style>

@section('content')
    <div class="page-content service-details common-single exchange-rate-single padding-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-details-item common-single-item exchange-rate-single-item position-relative">

                        <div class="d-flex flex-column align-items-center justify-content-lg-between flex-lg-row mb-3">
                            <h2 class="common-single-title exchange-rate-single-title mb-0">Statistics</h2>
                        </div>
                        @php $a = 1; @endphp

                        @isset($month_wise)
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>Month Wise & District Wise Arrival of Cotton</span>
                                    {{--                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>--}}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">District</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($month_wise as $key=>$data)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$data->district}}</td>
                                            <td>{{$data->year}}</td>
                                            <td>{{$data->year_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_1)->format('d-m-Y')}}</td>
                                            <td>{{$data->month1_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_2)->format('d-m-Y')}}</td>
                                            <td>{{$data->month2_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_3)->format('d-m-Y')}}</td>
                                            <td>{{$data->month3_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_4)->format('d-m-Y')}}</td>
                                            <td>{{$data->month4_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_5)->format('d-m-Y')}}</td>
                                            <td>{{$data->month5_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_6)->format('d-m-Y')}}</td>
                                            <td>{{$data->month6_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_7)->format('d-m-Y')}}</td>
                                            <td>{{$data->month7_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_8)->format('d-m-Y')}}</td>
                                            <td>{{$data->month8_value}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->month_9)->format('d-m-Y')}}</td>
                                            <td>{{$data->month9_value}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $month_wise->render() !!}
                            </div>
                        @endisset
                        @isset($export_of_raw)
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>Export Of Raw Cotton</span>
                                    {{--                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>--}}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Period</th>
                                        <th scope="col">Quantity/000 KG</th>
                                        <th scope="col">Value/000 US$</th>
                                        <th scope="col">Value/000 Rs</th>
                                        <th scope="col">Value US$/KG</th>
                                        <th scope="col">Value Rs/KG</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($export_of_raw as $key=>$data)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$data->period}}</td>
                                            <td>{{$data->quantity_000kg}}</td>
                                            <td>{{$data->value_000usd}}</td>
                                            <td>{{$data->value_000rs}}</td>
                                            <td>{{$data->value_usd_per_kg}}</td>
                                            <td>{{$data->vaue_rs_per_kg}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $export_of_raw->render() !!}
                            </div>
                        @endisset
                        @isset($production_export)
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>PRODUCTION, EXPORTS AND DOMESTIC REQUIREMENT OF YARN</span>
                                    {{--                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>--}}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Period</th>
                                        <th scope="col">Production</th>
                                        <th scope="col">Consumed In Mill Quantity</th>
                                        <th scope="col">Consumed In Mill % Prod</th>
                                        <th scope="col">Export Quantity</th>
                                        <th scope="col">Export % Prod</th>
                                        <th scope="col">Available For Local Market Quantity</th>
                                        <th scope="col">Available For Local Market % Prod</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($production_export as $key=>$data)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$data->period}}</td>
                                            <td>{{$data->production}}</td>
                                            <td>{{$data->consumed_in_mill_quantity}}</td>
                                            <td>{{$data->consumed_in_mill_prod}}</td>
                                            <td>{{$data->export_quantity}}</td>
                                            <td>{{$data->export_prod}}</td>
                                            <td>{{$data->available_for_local_market_quantity}}</td>
                                            <td>{{$data->available_for_local_market_prod}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $production_export->render() !!}
                            </div>
                        @endisset
                        @isset($global_impact)
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>PRODUCTION, EXPORTS AND DOMESTIC REQUIREMENT OF YARN</span>
                                    {{--                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>--}}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Date Range</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Area</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($global_impact as $key=>$data)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$data->country}}</td>
                                            <td>{{$data->date_range}}</td>
                                            <td>{{$data->value}}</td>
                                            <td>{{$data->zone}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $global_impact->render() !!}
                            </div>
                        @endisset
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
