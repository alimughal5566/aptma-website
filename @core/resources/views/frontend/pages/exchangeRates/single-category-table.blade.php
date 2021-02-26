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
@section('page-title')
{{--    {{$service_item->title}}--}}
@endsection
@section('content')


    <div class="page-content service-details common-single publication-single padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="common-single-title publication-single-title margin-bottom-15">Title</h3>
                </div>
                <div class="col-12">
                    <a href="#" class="btn" target="_blank">Download</a>
                </div>

                <div class="col-lg-12">
                    <div class="service-details-item common-single-item publication-single-item position-relative">
{{--                        {{dd($data->exchange[0])}}--}}
                        @php $a = 1; @endphp
                        @isset($data->exchange[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[1]){{$daily_state_categories[1]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$exchange_rates[0]->published_at}}</div>--}}
                            <table class="table table-striped">
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
                                <?php $counter = 1 ?>
                                @foreach($data->exchange as $exchange_rate)
                                    <tr>
                                        <th scope="row">{{$counter}}</th>
                                        <td>{{$exchange_rate->country}}</td>
                                        <td>{{$exchange_rate->currency}}</td>
                                        <td>{{$exchange_rate->selling}}</td>
                                        <td>{{$exchange_rate->buying}}</td>
                                    </tr>
                                    <?php $counter = ++$counter?>
                                @endforeach
                                </tbody>
                            </table>
                        @endisset
                        <br>
                        <br>
{{--                        {{dd($data->nyc[0])}}--}}
                        @isset($data->nyc[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[0]){{$daily_state_categories[0]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$nyc[0]->published_at}}</div>--}}
                            <table class="table table-striped">
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
                        @endisset
                        <br>
                        <br>
                        @isset($data->kca[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[5]){{$daily_state_categories[5]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$kca[0]->published_at}}</div>--}}
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">KCA Grafe 3 Spot</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $counter = 1 ?>
                                @foreach($data->kca as $kc)
                                    <tr>
                                        <th scope="row">{{$counter}}</th>
                                        <td>{{$kc->kca_grade_3_spot}}</td>
                                    </tr>
                                    <?php $counter = ++$counter?>
                                @endforeach
                                </tbody>
                            </table>
                        @endisset
                        <br>
                        <br>
                        @isset($data->cotlook[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[4]){{$daily_state_categories[4]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$cotlook[0]->published_at}}</div>--}}
                            <table class="table table-striped">
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
                        @endisset
                        <br>
                        <br>
                        @isset($data->export[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[2]){{$daily_state_categories[2]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$export[0]->published_at}}</div>--}}
                            <table class="table table-striped">
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
                                <?php $counter = 1 ?>
                                @foreach($data->export as $exp)
                                    <tr>
                                        <th scope="row">{{$counter}}</th>
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
                                    <?php $counter = ++$counter?>
                                @endforeach
                                </tbody>
                            </table>
                        @endisset
                        <br>
                        <br>

                        @isset($data->china[0])
{{--                            <div class="w-100 background-gray-light">@isset($daily_state_categories[3]){{$daily_state_categories[3]->title_description}}@endisset</div>--}}
{{--                            <div class="w-100 background-gray-light">{{$china_zce[0]->published_at}}</div>--}}
                            <table class="table table-striped">
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
                                <?php $counter = 1 ?>
                                @foreach($data->china as $china)
                                    <tr>
                                        <th scope="row">{{$counter}}</th>
                                        <td>{{$china->prod}}</td>
                                        <td>{{$china->last}}</td>
                                        <td>{{$china->chg}}</td>
                                        <td>{{$china->vol}}</td>
                                        <td>{{$china->open_interest}}</td>
                                    </tr>
                                    <?php $counter = ++$counter?>
                                @endforeach
                                </tbody>
                            </table>
                        @endisset

                        <div class="thumb">
                            {!! 'Thumbnail' !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
