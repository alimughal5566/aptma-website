@extends('frontend.frontend-page-master')
@section('site-title','Articles amd publications')


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
                Publications </h2>

            <div class="row">
                @php $a = 1; @endphp
                @isset($exchange_rates)
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
                        @foreach($exchange_rates as $exchange_rate)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td>{{$exchange_rate->country}}</td>
                                <td>{{$exchange_rate->currency}}</td>
                                <td>{{$exchange_rate->selling}}</td>
                                <td>{{$exchange_rate->buying}}</td>
                            </tr>
                            <?php $counter =++$counter?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <hr>
{{--                {{dd($nyc)}}--}}
                @isset($nyc)
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
                        @foreach($nyc as $ny)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td>{{$ny->contract}}</td>
                                <td>{{$ny->close}}</td>
                                <td>{{$ny->changes}}</td>
                            </tr>
                            <?php $counter =++$counter?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <hr>
{{--                {{dd($china_zce)}}--}}
                @isset($china_zce)
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
                        @foreach($china_zce as $china)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td>{{$china->prod}}</td>
                                <td>{{$china->last}}</td>
                                <td>{{$china->chg}}</td>
                                <td>{{$china->vol}}</td>
                                <td>{{$china->open_interest}}</td>
                            </tr>
                            <?php $counter =++$counter?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <hr>
                @isset($export)
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
                        @foreach($export as $exp)
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
                            <?php $counter =++$counter?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>
@endsection
