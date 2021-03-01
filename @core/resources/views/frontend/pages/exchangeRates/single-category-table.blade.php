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
@section('site-title')
    {{--    {{$service_item->title}} -  {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}--}}
@endsection

@section('site-title','Daily Exchange Rates')

@section('content')


    <div class="page-content service-details common-single exchange-rate-single padding-top-50 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-details-item common-single-item exchange-rate-single-item position-relative">

                        <div class="d-flex flex-column align-items-center justify-content-lg-between flex-lg-row mb-3">
                            <h2 class="common-single-title exchange-rate-single-title mb-0">Daily Exchange Rates <span>{{Carbon\Carbon::parse($date)->format('d M Y')}}</span></h2>
                            <a href="#" class="btn" target="_blank">Download</a>
                        </div>

                        @php $a = 1; @endphp
                        @isset($data->exchange[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[1]){{$daily_state_categories[1]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$exchange_rates[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>Exchange Rates</span>
                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Selling</th>
                                        <th scope="col">Buying</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->exchange as $key=>$exchange_rate)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$exchange_rate->country}}</td>
                                            <td>{{$exchange_rate->currency}}</td>
                                            <td>{{$exchange_rate->selling}}</td>
                                            <td>{{$exchange_rate->buying}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                        <br>
                        <br>
                        @isset($data->export[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[2]){{$daily_state_categories[2]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$export[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>Export Bill Discounting Rate</span>
                                    <span>{{Carbon\Carbon::parse($date)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Spot</th>
                                        <th scope="col">Sight/OD</th>
                                        <th scope="col">1 Month</th>
                                        <th scope="col">2 Month</th>
                                        <th scope="col">3 Month</th>
                                        <th scope="col">4 Month</th>
                                        <th scope="col">5 Month</th>
                                        <th scope="col">6 Month</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->export as $key=>$exp)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$exp->currency}}</td>
                                            <td>{{$exp->spot}}</td>
                                            <td>{{$exp->sight_od}}</td>
                                            <td>{{$exp->first_month}}</td>
                                            <td>{{$exp->second_month}}</td>
                                            <td>{{$exp->thirs_month}}</td>
                                            <td>{{$exp->fourth_month}}</td>
                                            <td>{{$exp->fifth_month}}</td>
                                            <td>{{$exp->sixth_month}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                        <br>
                        <br>
                        @isset($data->cotlook[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[4]){{$daily_state_categories[4]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$cotlook[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>Cotlook ‘A’ Index</span>
                                    <span>{{Carbon\Carbon::parse($date)->addDays(-2)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">A Index</th>
                                        <th scope="col">A Index Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1 ?>
                                    @foreach($data->cotlook as $cot)
                                        <tr>
                                            <th scope="row">{{$counter}}</th>
                                            <td>{{$cot->a_index}}</td>
                                            <td>{{$cot->a_index_change}}</td>
                                        </tr>
                                        <?php $counter = ++$counter?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                        <br>
                        <br>
                        @isset($data->nyc[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[0]){{$daily_state_categories[0]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$nyc[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>NYC US cent/lb</span>
                                    <span>{{Carbon\Carbon::parse($date)->addDays(-1)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Contract</th>
                                        <th scope="col">Close</th>
                                        <th scope="col">Changes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $counter = 1 ?>
                                    @foreach($data->nyc as $ny)
                                        <tr>
                                            <th scope="row">{{$counter}}</th>
                                            <td>{{$ny->contract}}</td>
                                            <td>{{$ny->close}}</td>
                                            <td>{{$ny->changes}}</td>
                                        </tr>
                                        <?php $counter = ++$counter?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                        <br>
                        <br>
                        @isset($data->kca[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[5]){{$daily_state_categories[5]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$kca[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                <h3 class="text-white mb-0">KCA Pak Rs / Maund 40 Kg
                                    <span>{{Carbon\Carbon::parse($date)->addDays(-1)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">KCA Grafe 3 Spot</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->kca as $key=>$kc)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$kc->kca_grade_3_spot}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset
                        <br>
                        <br>
                        @isset($data->china[0])
                            {{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[3]){{$daily_state_categories[3]->title_description}}@endisset</div>--}}
                            {{--                            <div class="w-100 background-gray-light">{{$china_zce[0]->published_at}}</div>--}}
                            <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                <h3 class="text-white mb-0">
                                    <span>China ZCE Cotton No. 1 Rates</span>
                                    <span>{{Carbon\Carbon::parse($date)->addDays(-1)->format('M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Prod</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Chg</th>
                                        <th scope="col">Vol</th>
                                        <th scope="col">Open Interest</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->china as $key=>$china)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$china->prod}}</td>
                                            <td>{{$china->last}}</td>
                                            <td>{{$china->chg}}</td>
                                            <td>{{$china->vol}}</td>
                                            <td>{{$china->open_interest}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
