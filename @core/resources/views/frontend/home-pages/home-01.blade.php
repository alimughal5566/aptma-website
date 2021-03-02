@section('site-title','Home')


<div class="header-slider-one">
    @foreach($all_header_slider as $data)
        <div class="header-area header-bg" {!! render_background_image_markup_by_attachment_id($data->image) !!}>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-inner">
                            @if(!empty($data->subtitle))
                                <p class="subtitle">{{$data->subtitle}}</p>
                            @endif
                            @if(!empty($data->title))
                                <h1 class="title">{{$data->title}}</h1>
                            @endif
                            @if(!empty($data->description))
                                <p class="description">{{$data->description}}</p>
                            @endif
                            @if(!empty($data->btn_01_status))
                                <div class="btn-wrapper  desktop-left padding-top-30">
                                    <a href="{{$data->btn_01_url}}" class="boxed-btn ">{{$data->btn_01_text}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<section class="common-area background-gray-light-lightest padding-top-50 ">
    <div class="container-fluid common-container">
        <div class="row">
            {{--            <div class="col-12 col-lg-1"></div>--}}
            {{--            <div class="col-12 col-lg-10">--}}
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        @if($publications->count()>0)
                            <div class="bg-white rounded px-2 px-lg-3 padding-bottom-30 margin-bottom-50">
                                <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row padding-30">
                                    <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Latest Articles & Publications'}}</h3>
                                    {{--                    <p class="desc">{{''}}</p>--}}
                                    <a href="{{route('frontend.publication')}}" class="btn">View All</a>
                                </div>
                                <div class="common-grid-carousel-wrapper ">
                                    <div class="common-grid-carousel publication-grid-carousel">
                                        @foreach($publications as $data)
                                            <div class="common-grid-carousel-item">
                                                <div class="common-item publication-item single-what-we-cover-item-02 ">
                                                    <div class="common-img publication-img single-what-img position-relative">
                                                        @php
                                                            $now = Carbon\Carbon::now();
                                                            $datework = Carbon\Carbon::parse($data->created_at);
                                                            $diff = $datework->diffInDays($now);
                                                        @endphp
                                                        @if($diff<15)
                                                            <small class=" font-italic badge">New</small>
                                                        @endif

                                                        <a class="align-items-center"
                                                           href="{{route('frontend.publication.single',$data->slug)}}">
                                                            {!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>
                                                    </div>
                                                    <div class="common-content content">
                                                        <a href="{{route('frontend.publication.single',$data->slug)}}">
                                                            <h4 class="title">{{$data->title}}</h4>
                                                        </a>
                                                        <p>{{@$data->category->name}}</p>
                                                        <a href="{{asset('assets/uploads/publications/'.$data->pdf_url)}}"
                                                           class="btn" download>Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($all_events->count()>0)
                            <div class="bg-white rounded px-2 px-lg-3 padding-bottom-30">
                                <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                    <h3 class="mb-0 font-weight-bold">{{'Latest Events'}}</h3>
                                    {{--                    <p class="desc">{{''}}</p>--}}
                                    <a href="{{route('frontend.events')}}" class="btn">View All</a>
                                </div>
                                <div class="common-grid-carousel-wrapper events-grid-carosel-wrapper">
                                    <div class="common-grid-carousel events-grid-carousel">
                                        @foreach($all_events as $data)
                                            <div class="common-grid-carousel-item single-events-list-item rounded flex-column position-relative">
                                                <div class="common-img thumb mr-0">
                                                    <div class="align-items-center thumb-wrap ">
                                                        <a href="{{route('frontend.events.single',$data->slug)}}">
                                                            {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="common-content content-area">
                                                    <div class="top-part mb-0 py-2 flex-column">
                                                        <div class="detail-wrap w-100">
                                                            <div class="date-time-wrap d-flex flex-column justify-content-center align-items-center align-items-lg-start">
                                                                <span class="date-span">{{date('d M Y',strtotime($data->date))}}</span>
                                                                <span class="time-span">{{$data->time}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="title-wrap py-1">
                                                            <a href="{{route('frontend.events.single',$data->slug)}}">
                                                                <h4 class="title mb-0">{{$data->title}}</h4>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                        <span class="location d-flex align-items-center">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <span class="ml-2">{{$data->venue_location}}</span>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-lg-3">
                        {{--                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30 ">--}}
                        {{--                                <h3 class="mb-0 font-weight-bold">{{'Social Feeds'}}</h2>--}}
                        {{--                                --}}{{--                    <p class="desc">{{''}}</p>--}}
                        {{--                            </div>--}}
                        <div class="row bg-white rounded ">
                            <div class="col-12">
                                <div class="social-feeds px-2 px-lg-3 pt-3 pb-0">
                                    <div class="social-feeds-block bg-white rounded d-flex flex-column justify-content-center">
                                        <div class="d-flex flex-column">
                                            {{--                                                @if($data->icon == "fab fa-twitter" || $data->icon == "fab fa-facebook-f")--}}
                                            {{--                                                {{$data->url}}--}}
                                            {{--                                                {$data->icon}}--}}
                                            <span class="social-feed-item d-flex justify-content-center my-1">
                                                <a href="https://twitter.com/aptmaofficial" target="_blank">
                                                    <i class="fab fa-twitter"></i>
{{--                                                    <span>Twitter</span>--}}
                                                </a>
                                            </span>
                                            <div>
                                                <a class="twitter-timeline" data-height="498"
                                                   href="https://twitter.com/aptmaofficial">APTMA</a>
                                                <script async src="https://platform.twitter.com/widgets.js"
                                                        charset="utf-8"></script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="social-feeds bg-white rounded px-2 px-lg-3 py-3">
                                    <div class="social-feeds-block bg-white rounded d-flex flex-column justify-content-center ">
                                        <div class="d-flex flex-column">
                                            <span class="social-feed-item d-flex justify-content-center mt-1 mb-2">
                                                <a href="https://www.facebook.com/APTMAOfficial1" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
{{--                                                    <span>Facebook</span>--}}
                                                </a>
                                            </span>
                                            <div>
                                                <!-- Load Facebook SDK for JavaScript -->
                                                <div id="fb-root"></div>
                                                <script async defer crossorigin="anonymous" nonce="z0b43ddy"
                                                        src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0"></script>
                                                <!-- Your share button code -->
                                                <div class="fb-page"
                                                     data-href="https://www.facebook.com/APTMAOfficial1"
                                                     data-tabs="timeline" data-width="" data-height="425"
                                                     data-small-header="false" data-adapt-container-width="true"
                                                     data-hide-cover="false" data-show-facepile="true">
                                                    <blockquote cite="https://www.facebook.com/APTMAOfficial1"
                                                                class="fb-xfbml-parse-ignore">
                                                        <a href="https://www.facebook.com/APTMAOfficial1">APTMA</a>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-12 col-lg-1"></div>--}}
        </div>
    </div>
</section>

{{--<section class="common-area event-area background-gray-light-lightest padding-top-50 ">--}}
{{--    <div class="container-fluid common-container event-container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-1"></div>--}}
{{--            <div class="col-12 col-lg-10">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-lg-1"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<section class="common-area dailyupdates-area background-gray-light-lightest padding-top-50">
    <div class="container-fluid common-container dailyupdates-container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">

                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">
                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Daily Exchange &  Cotton Rate'}}</h3>
                                {{--                    <p class="desc">{{''}}</p>--}}
                                <a href="{{route('frontend.daily.stats')}}" class="btn">View All</a>
                            </div>
                            <div class="tab-content-section">
                                <div>
                                    <ul class="nav nav-pills justify-content-center mb-2" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-exchange-rate-tab" data-toggle="pill"
                                               href="#pills-exchange-rate" role="tab"
                                               aria-controls="pills-exchange-rate" aria-selected="true">Exchange
                                                Rate</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-export-bill-tab" data-toggle="pill"
                                               href="#pills-export-bill" role="tab" aria-controls="pills-export-bill"
                                               aria-selected="false">Export Bill</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-china-zce-tab" data-toggle="pill"
                                               href="#pills-china-zce" role="tab" aria-controls="pills-china-zce"
                                               aria-selected="false">China ZCE</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-exchange-rate" role="tabpanel"
                                             aria-labelledby="pills-exchange-rate-tab">
                                            {{--                                            Exchange Rate--}}
                                            {{--                                            {{dd($daily_state_categories)}}--}}
                                            @php $a = 1; @endphp
                                            {{--                                            {{dd($excel_sheets->nyc)}}--}}
                                            @isset($excel_sheets->exchange[0])
                                                <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                                    <h3 class="text-white mb-0">
                                                        <span>Exchange Rates</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->date)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>
                                                <div class="table-responsive">
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
                                                        @foreach($excel_sheets->exchange as $exchange_rate)
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
                                                </div>
                                            @endisset

                                            @isset($excel_sheets->nyc[0])
                                                <div class="w-100 background-gray-light">@isset($daily_state_categories[0]){{$daily_state_categories[0]->title_description}}@endisset</div>
                                                <div class="w-100 background-gray-light">{{$excel_sheets->published_at}}</div>
                                                <div class="px-3 py-2 background-primary2 text-center font-weight-bold">
                                                    <h3 class="text-white mb-0">
                                                        <span>NYC US cent/lb</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->published_at)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>
                                                <div class="table-responsive">
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
                                                        @foreach($excel_sheets->nyc as $ny)
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
                                            @isset($excel_sheets->kca[0])
                                                <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                                    <h3 class="text-white mb-0 d-flex flex-column align-items-center">
                                                        <span>KCA Pak Rs / Maund 40 Kg</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->date)->addDays(-1)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">KCA Grafe 3 Spot</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $counter = 1 ?>
                                                        @foreach($excel_sheets->kca as $kc)
                                                            <tr>
                                                                <th scope="row">{{$counter}}</th>
                                                                <td>{{$kc->kca_grade_3_spot}}</td>
                                                            </tr>
                                                            <?php $counter = ++$counter?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endisset
                                            <br>
                                            <br>
                                            {{--                                                                                        {{dd($daily_state_categories)}}--}}
                                            @isset($excel_sheets->cotlook[0])
                                                <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                                    <h3 class="text-white mb-0 d-flex flex-column align-items-center">
                                                        <span>Cotlook ‘A’ Index</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->date)->addDays(-2)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>
                                                <div class="table-responsive">
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
                                                        @foreach($excel_sheets->cotlook as $cot)
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
                                        </div>
                                        <div class="tab-pane fade" id="pills-export-bill" role="tabpanel"
                                             aria-labelledby="pills-export-bill-tab">
                                            {{--                                            Export Bill--}}
                                            @isset($excel_sheets->export[0])
                                                <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                                    <h3 class="text-white mb-0">
                                                        <span>Export Bill Discounting Rate</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->date)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>

                                                <div class="table-responsive">
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
                                                        @foreach($excel_sheets->export as $exp)
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
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="tab-pane fade" id="pills-china-zce" role="tabpanel"
                                             aria-labelledby="pills-china-zce-tab">
                                            {{--                                            China ZCE--}}
                                            @isset($excel_sheets->china[0])
                                                <div class="px-3 py-2 background-primary2 text-white text-center font-weight-bold">
                                                    <h3 class="text-white mb-0">
                                                        <span>China ZCE Cotton No. 1 Rates</span>
                                                        <span>{{Carbon\Carbon::parse($excel_sheets->date)->format('M d, Y')}}</span>
                                                    </h3>
                                                </div>
                                                <div class="table-responsive">
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
                                                        @foreach($excel_sheets->china as $china)
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
                                                </div>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--Start Tag--}}
{{--This Section will be displayed to only Members & When code for that then we will add it up--}}

{{--<section class="common-area circular-area background-gray-light-lightest padding-top-50 ">--}}
{{--    <div class="container-fluid common-container circular-container">--}}
{{--        <div class="row">--}}
{{--            --}}{{--            <div class="col-12 col-lg-1"></div>--}}
{{--            --}}{{--            <div class="col-12 col-lg-10">--}}
{{--            <div class="col-12">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">--}}
{{--                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row padding-30">--}}
{{--                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Latest Circulars'}}</h3>--}}
{{--                                --}}{{--                                <p class="desc">{{''}}</p>--}}
{{--                                <a href="{{route('frontend.circular.index')}}" class="btn">View All</a>--}}

{{--                            </div>--}}
{{--                            <div class="common-grid-carousel-wrapper">--}}
{{--                                <div class="common-grid-carousel circular-grid-carousel">--}}
{{--                                    @foreach($circulars as $data)--}}
{{--                                        <div class="common-grid-carousel-item">--}}
{{--                                            <div class="common-item circular-item single-what-we-cover-item-02 ">--}}
{{--                                                <div class="common-img circular-img single-what-img position-relative">--}}
{{--                                                    @php--}}
{{--                                                        $now = Carbon\Carbon::now();--}}
{{--                                                        $datework = Carbon\Carbon::parse($data->created_at);--}}
{{--                                                        $diff = $datework->diffInDays($now);--}}
{{--                                                    @endphp--}}
{{--                                                    @if($diff<15)--}}
{{--                                                        <small class=" font-italic badge">New</small>--}}
{{--                                                    @endif--}}

{{--                                                    <a href="{{route('frontend.circular.single',$data->slug)}}">--}}
{{--                                                        {!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="common-content content">--}}
{{--                                                    <a href="{{route('frontend.circular.single',$data->slug)}}">--}}
{{--                                                        <h4 class="title">{{$data->title}}</h4>--}}
{{--                                                    </a>--}}
{{--                                                    <p>{{@$data->category->name}}</p>--}}
{{--                                                    <p>{{@$data->publish_date}}</p>--}}
{{--                                                    <a href="{{asset('assets/uploads/circular/'.$data->url)}}"--}}
{{--                                                       class="btn">Download</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}{{--            <div class="col-12 col-lg-1"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

{{--
// End Tag
This Section will be displayed to only Members & When code for that then we will add it up
--}}

<section class="common-area economic-area background-gray-light-lightest padding-top-50 ">
    <div class="container-fluid common-container economic-container">
        <div class="row">
            {{--            <div class="col-12 col-lg-1"></div>--}}
            {{--            <div class="col-12 col-lg-10">--}}
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">
                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Daily Economic Updates'}}</h3>
                                {{--                    <p class="desc">{{''}}</p>--}}
                                <a href="{{route('frontend.dailyEconomicsUpdate')}}" class="btn">View All</a>
                            </div>
                            <div class="common-grid-carousel-wrapper">
                                <div class="common-grid-carousel economic-grid-carousel">
                                    @foreach($all_daily_economic as $data)
                                        <div class="common-grid-carousel-item">
                                            <div class="common-item economic-item single-what-we-cover-item-02 ">

                                                {{--                                                <div class="common-img economic-img single-what-img position-relative">--}}
                                                {{--                                                    @php--}}
                                                {{--                                                        $now = Carbon\Carbon::now();--}}
                                                {{--                                                        $datework = Carbon\Carbon::parse($data->created_at);--}}
                                                {{--                                                        $diff = $datework->diffInDays($now); @endphp--}}
                                                {{--                                                    @if($diff<15)--}}
                                                {{--                                                        <small class=" font-italic badge ">New</small>--}}
                                                {{--                                                    @endif--}}

                                                {{--                                                    <a class="align-items-center"--}}
                                                {{--                                                       href="{{route('frontend.economic.single', $data->slug)}}">--}}
                                                {{--                                                        --}}{{--                                                        {!! render_image_markup_by_attachment_id($data->thumbnail) !!}--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                </div>--}}

                                                <div class="common-content content">
                                                    <a href="{{route('frontend.economic.single', $data->slug)}}">
                                                        <h4 class="title d-flex align-items-center">{{$data->title}}</h4>
                                                    </a>
                                                    <a href="{{route('frontend.economic.single', $data->slug)}}"
                                                       target="_blank" class="btn">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-12 col-lg-1"></div>--}}
        </div>
    </div>
</section>

<section class="common-area advertise-area background-gray-light-lightest padding-top-50 ">
    <div class="container-fluid common-container advertise-container">
        <div class="row">
            {{--            <div class="col-12 col-lg-1"></div>--}}
            {{--            <div class="col-12 col-lg-10">--}}
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">
                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Latest Advertisement'}}</h3>
                                {{--                    <p class="desc">{{''}}</p>--}}
                                <a href="{{route('frontend.advertisement.index')}}" class="btn">View All</a>
                            </div>
                            <div class="common-grid-carousel-wrapper">
                                <div class="common-grid-carousel advertise-grid-carousel">
                                    @foreach($advertisements as $data)
                                        <div class="common-grid-carousel-item">
                                            <div class="common-item advertise-item single-what-we-cover-item-02 ">
                                                <a class="align-items-center"
                                                   href="{{route('frontend.advertisement.single',['slug' => $data->slug])}}">
                                                    <div class="common-img advertise-img single-what-img position-relative">
                                                        @php
                                                            $now = Carbon\Carbon::now();
                                                            $datework = Carbon\Carbon::parse($data->created_at);
                                                            $diff = $datework->diffInDays($now);
                                                        @endphp
                                                        @if($diff<15)
                                                            <small class="font-italic badge">New</small>
                                                        @endif
                                                        {!! render_image_markup_by_attachment_id($data->thumbnail,'ss') !!}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-12 col-lg-1"></div>--}}
        </div>
    </div>
</section>

<section class="common-area video-area background-gray-light-lightest padding-50 ">
    <div class="container-fluid common-container video-container">
        <div class="row">
            {{--            <div class="col-12 col-lg-1"></div>--}}
            {{--            <div class="col-12 col-lg-10">--}}
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">
                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Latest Videos'}}</h3>
                                {{--                    <p class="desc">{{''}}</p>--}}
                                <a href="{{route('frontend.gallery.video.index')}}" class="btn">View All</a>
                            </div>
                            <div class="common-grid-carousel-wrapper">
                                <div class="common-grid-carousel video-grid-carousel">
                                    @foreach($videos as $data)
                                        <div class="common-grid-carousel-item">
                                            <div class="common-item video-item single-what-we-cover-item-02 ">
                                                <div class="common-img video-img single-what-img position-relative">
                                                    @php
                                                        $now = Carbon\Carbon::now();
                                                        $datework = Carbon\Carbon::parse($data->created_at);
                                                        $diff = $datework->diffInDays($now); @endphp
                                                    @if($diff<15)
                                                        <small class=" font-italic badge ">New</small>
                                                    @endif

                                                    <a class="align-items-center"
                                                       href="{{route('frontend.gallery.video.single', $data->slug)}}"
                                                       target="_blank">
                                                        {!! render_image_markup_by_attachment_id($data->thumbnail) !!}
                                                    </a>
                                                </div>
                                                <div class="common-content content">
                                                    <a href="{{route('frontend.gallery.video.single', $data->slug)}}">
                                                        <h4 class="title d-flex align-items-center">{{$data->title}}</h4>
                                                    </a>
                                                    <a href="{{$data->url}}" target="_blank" class="btn">View</a>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-12 col-lg-1"></div>--}}
        </div>
    </div>
</section>

{{--<section class="common-area book-area background-gray-light-lightest padding-top-50 ">--}}
{{--    <div class="container-fluid common-container book-container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-1"></div>--}}
{{--            <div class="col-12 col-lg-10">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class=" bg-white rounded px-2 px-lg-3 padding-bottom-30">--}}
{{--                            <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">--}}
{{--                                <h3 class="mb-0 font-weight-bold margin-bottom-0">{{'Latest Books'}}</h2>--}}
{{--                                                    <p class="desc">{{''}}</p>--}}
{{--                            </div>--}}
{{--                            <div class="common-grid-carousel-wrapper">--}}
{{--                                <div class="common-grid-carousel books-grid-carousel">--}}
{{--                                    @foreach($books as $data)--}}
{{--                                        <div class="common-grid-carousel-item">--}}
{{--                                            <div class="common-item book-item single-what-we-cover-item-02 ">--}}
{{--                                                <div class="common-img book-img single-what-img position-relative">--}}
{{--                                                    @php--}}
{{--                                                        $now = Carbon\Carbon::now();--}}
{{--                                                        $datework = Carbon\Carbon::parse($data->created_at);--}}
{{--                                                        $diff = $datework->diffInDays($now);--}}
{{--                                                    @endphp--}}
{{--                                                    @if($diff<15)--}}
{{--                                                        <small class=" font-italic badge">New</small>--}}
{{--                                                    @endif--}}

{{--                                                    <a href="{{route('frontend.book.single',$data->slug)}}">--}}
{{--                                                        {!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>--}}
{{--                                                </div>--}}
{{--                                                <div class="common-content content">--}}
{{--                                                    <a href="{{route('frontend.book.single',$data->slug)}}">--}}
{{--                                                        <h4 class="title">{{$data->title}}</h4>--}}
{{--                                                    </a>--}}
{{--                                                    <p>{{@$data->category->name}}</p>--}}
{{--                                                    <a href="{{asset('assets/uploads/books/'.$data->url)}}" class="btn">Download</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-lg-1"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

@if(!empty(get_static_option('home_page_latest_news_section_status')))
    <section class="common-area blog-area background-gray-light-lightest padding-50">
        <div class="container-fluid common-container">
            <div class="row">
                {{--                <div class="col-12 col-lg-1"></div>--}}
                {{--                <div class="col-12 col-lg-10">--}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class=" bg-white rounded px-2 px-lg-3 padding-top-50 padding-bottom-30">
                                <div class="section-title d-flex justify-content-md-between align-items-center flex-column flex-md-row  padding-30">
                                    <h3 class="mb-0 font-weight-bold">{{'Latest News & Articles'}}</h3>
                                    {{--                        <h3 class="title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_latest_news_title')}}</h3>--}}
                                    {{--                        <p class="text-dark">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_latest_news_description')}} </p>--}}
                                    <a href="{{route('frontend.blog')}}" class="btn">View All</a>

                                </div>
                                <div class="common-grid-carousel-wrapper blog-grid-carosel-wrapper">
                                    <div class="common-grid-carousel blog-grid-carousel">
                                        @foreach($all_blog as $data )
                                            <div class="common-grid-carousel-item single-blog-grid-01">
                                                <div class="common-img blog-image w-100 h-100" {!! render_background_image_markup_by_attachment_id($data->image,'large') !!}>
                                                </div>
                                                <div class="common-content content">
                                                    <ul class="post-meta mb-2 d-flex flex-column">
                                                        <li>
                                                            <a href="{{route('frontend.blog.single', $data->slug)}}">
                                                                <i class="far fa-clock"></i> {{date_format($data->created_at,'d M Y')}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="cats">
                                                                <i class="fas fa-tags"></i> {!! get_blog_category_by_id($data->blog_categories_id,'link') !!}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <h4 class="title mb-0">
                                                        <a href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="col-12 col-lg-1"></div>--}}
            </div>
        </div>
    </section>
@endif

@if(!empty(get_static_option('home_page_key_feature_section_status')))
    <div class="header-bottom-area key-feature background-primary3-lightest padding-bottom-70">
        <div class="header-bottom-inner">
            <div class="container">
                <div class="row">
                    @foreach($all_key_features as $key => $data)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-header-bottom-item style-0{{$key+1}}">
                                <div class="icon">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">{{$data->title}}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

{{--@if(!empty(get_static_option('home_page_about_us_section_status')))--}}
{{--    <section class="top-experience-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="experience-content">--}}
{{--                        <div class="content">--}}
{{--                            <h3 class="title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_title')}}</h2>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-09 offset-lg-3">--}}
{{--                            <div class="experience-right">--}}
{{--                                <div class="experience-img">--}}
{{--                                    {!! render_image_markup_by_attachment_id(get_static_option('home_page_01_about_us_video_background_image')) !!}--}}
{{--                                </div>--}}
{{--                                <div class="vdo-btn">--}}
{{--                                    <a class="video-play-btn mfp-iframe"--}}
{{--                                       href="{{get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_video_url')}}"><i--}}
{{--                                                class="fas fa-play"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}

@if(!empty(get_static_option('home_page_about_us_section_status')))
    <div class="our-mission-area">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="our-service-wrappper bg-main padding-top-100 padding-bottom-15">
                        <div class="section-title white padding-bottom-15 desktop-left">
                            <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_title')}}</h3>
                            <p class="m-inherit">{!! get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_description') !!}</p>
                            <div class="service-area-work">
                                @foreach($all_key_features as $key => $data)
                                    <div class="single-header-bottom-item-04">
                                        <div class="icon">
                                            <i class="{{$data->icon}}"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{$data->title}}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-item-wrapper">
                        <div class="single-service-item">
                            <div class="service-img">
                                <div class="bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_04_about_us_our_mission_image')) !!}></div>
                            </div>
                            <div class="service-text">
                                <div class="service-text-inner">
                                    <h3 class="title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_our_mission_title')}}</h3>
                                    <p>{!! get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_our_mission_description') !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-service-item">
                            <div class="service-text">
                                <div class="service-text-inner">
                                    <h3 class="title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_our_vision_title')}}</h3>
                                    <p>{!! get_static_option('home_page_01_'.$user_select_lang_slug.'_about_us_our_vision_description') !!}</p>
                                </div>
                            </div>
                            <div class="service-img style-01">
                                <div class="bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_04_about_us_our_vision_image')) !!}></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(get_static_option('home_page_service_section_status')))
    <section class="what-we-cover bg-image padding-top-110 padding-bottom-90"
            {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_01_service_area_background_image')) !!}>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title white desktop-center margin-bottom-55">
                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_service_area_title')}}</h3>
                        <p>{{get_static_option('home_page_01_'.$user_select_lang_slug.'_service_area_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a = 1; @endphp
                @if(get_static_option('home_page_01_service_area_item_type') == 'category')
                    @foreach($all_service_category as $data)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-what-we-cover-item style-01 margin-bottom-30">
                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                    <div class="icon style-0{{$a }}">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                @else
                                    <div class="img-icon style-0{{$a}}">
                                        {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                    </div>
                                @endif
                                <div class="content">
                                    <h4 class="title">
                                        <a href="{{route('frontend.services.category',[ 'id' => $data->id , 'any' => Str::slug($data->name)])}}">{{$data->name}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @php  if($a == 4){ $a = 1;}else{$a++;}; @endphp
                    @endforeach
                @else
                    @foreach($all_service as $data)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-what-we-cover-item style-01 margin-bottom-30">
                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                    <div class="icon style-0{{$a }}">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                @else
                                    <div class="img-icon style-0{{$a}}">
                                        {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                    </div>
                                @endif
                                <div class="content">
                                    <h4 class="title"><a
                                                href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                    </h4>
                                    <p>{{$data->excerpt}}</p>
                                </div>
                            </div>
                        </div>
                        @php  if($a == 4){ $a = 1;}else{$a++;}; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endif

{{--@if(!empty(get_static_option('home_page_service_section_status')))--}}
{{--    <section class="what-we-cover padding-bottom-85 padding-top-100">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="section-title desktop-center margin-bottom-50">--}}
{{--                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_service_area_title')}}</h3>--}}
{{--                        <p>{{get_static_option('home_page_01_'.$user_select_lang_slug.'_service_area_description')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @if(get_static_option('home_page_01_service_area_item_type') == 'category')--}}
{{--                @foreach($all_service_category->chunk(3) as $row)--}}
{{--                    <div class="row">--}}
{{--                        @foreach($row as $key => $data)--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                                <div class="single-what-we-cover-item margin-bottom-50">--}}
{{--                                    @if($data->icon_type == 'icon' || $data->icon_type == '')--}}
{{--                                        <div class="icon style-0{{$key+1}}">--}}
{{--                                            <i class="{{$data->icon}}"></i>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="img-icon">--}}
{{--                                            {!! render_image_markup_by_attachment_id($data->img_icon) !!}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="content">--}}
{{--                                        <h4 class="title">--}}
{{--                                            <a href="{{route('frontend.services.category',[ 'id' => $data->id , 'any' => Str::slug($data->name)])}}">{{$data->name}}</a>--}}
{{--                                        </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @else--}}
{{--                @foreach($all_service->chunk(3) as $row)--}}
{{--                    <div class="row">--}}
{{--                        @foreach($row as $key => $data)--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                                <div class="single-what-we-cover-item margin-bottom-50">--}}
{{--                                    @if($data->icon_type == 'icon' || $data->icon_type == '')--}}
{{--                                        <div class="icon style-0{{$key+1}}">--}}
{{--                                            <i class="{{$data->icon}}"></i>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="img-icon">--}}
{{--                                            {!! render_image_markup_by_attachment_id($data->img_icon) !!}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="content">--}}
{{--                                        <h4 class="title"><a--}}
{{--                                                    href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>--}}
{{--                                        </h4>--}}
{{--                                        <p>{{$data->excerpt}}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}

@if(!empty(get_static_option('home_page_quality_section_status')))
    <div class="quality-area">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="quality-img" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_01_quality_area_background_image')) !!}></div>
                </div>
                <div class="col-lg-6">
                    <div class="quality-content">
                        <div class="quality-content-wrapper">
                            <h4 class="title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_quality_area_title')}}</h4>
                            <p>{!! get_static_option('home_page_01_'.$user_select_lang_slug.'_quality_area_description') !!}</p>

                            @if(!empty(get_static_option('home_page_01_'.$user_select_lang_slug.'_quality_area_button_status')))
                                <div class="btn-wrapper margin-top-40">
                                    <a href="{{get_static_option('home_page_01_'.$user_select_lang_slug.'_quality_area_button_url')}}"
                                       class="boxed-btn">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_quality_area_button_title')}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(get_static_option('home_page_case_study_section_status')))
    <div class="case-studies-area-03 background-primary2-lightest padding-bottom-120">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title desktop-center padding-top-110 padding-bottom-50">
                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_case_study_title')}}</h3>
                        <p>{{get_static_option('home_page_01_'.$user_select_lang_slug.'_case_study_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01">
                            <li class="active" data-filter="*">{{__('All')}}</li>
                            @foreach($all_work_category as $data)
                                <li data-filter=".{{Str::slug($data->name)}}">{{$data->name}}</li>
                            @endforeach
                        </ul>
                        <div class="case-studies-masonry">
                            @foreach($all_work as $data)
                                <div class="col-lg-4 col-md-4 col-sm-6 masonry-item {{get_work_category_by_id($data->id,'slug')}}">
                                    <div class="single-case-studies-item">
                                        <div class="thumb">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <div class="cart-icon">
                                            <h4 class="title"><a
                                                        href="{{route('frontend.work.single',$data->slug)}}"> {{$data->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{--@if(!empty(get_static_option('home_page_case_study_section_status')))--}}
{{--    <div class="case-studies-area">--}}
{{--        <div class="container-fluid p-0">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="section-title white bg-blue desktop-center padding-top-110 padding-bottom-55">--}}
{{--                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_case_study_title')}}</h3>--}}
{{--                        <p>{{get_static_option('home_page_01_'.$user_select_lang_slug.'_case_study_description')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="case-studies-slider-active">--}}
{{--                        @foreach($all_work as $data)--}}
{{--                            <div class="slider-img"--}}
{{--                                    {!! render_background_image_markup_by_attachment_id($data->image) !!}--}}
{{--                            >--}}
{{--                                <div class="slider-inner-text">--}}
{{--                                    <a href="{{route('frontend.work.single',$data->slug)}}">--}}
{{--                                        <h4 class="title">{{$data->title}}</h4>--}}
{{--                                    </a>--}}
{{--                                    <p>{{$data->excerpt}}</p>--}}
{{--                                    <div class="btn-wrapper padding-top-20">--}}
{{--                                        <a href="{{route('frontend.work.single',$data->slug)}}"--}}
{{--                                           class="boxed-btn">{{get_static_option('case_study_'.$user_select_lang_slug.'_read_more_text')}}</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}


{{--@if(!empty(get_static_option('home_page_counterup_section_status')))--}}
{{--    <div class="counterup-area counterup-bg padding-30">--}}
{{--        <div class="container counter-container bg-white padding-top-20 padding-bottom-20">--}}
{{--            <div class="row">--}}
{{--                @foreach($all_counterup as $data)--}}
{{--                    <div class="col-lg-3 col-md-6">--}}
{{--                        <div class="singler-counterup-item singler-counterup-item-01">--}}
{{--                            <div class="icon">--}}
{{--                                <i class="{{$data->icon}}" aria-hidden="true"></i>--}}
{{--                            </div>--}}
{{--                            <div class="content">--}}
{{--                                <div class="count-wrap">--}}
{{--                                    <span class="count-num">{{$data->number}}</span>--}}
{{--                                    <span class="count-text">{{$data->extra_text}}</span>--}}
{{--                                </div>--}}
{{--                                <h4 class="title">{{$data->title}}</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

@if(!empty(get_static_option('home_page_call_to_action_section_status')))
    <div class="call-to-action bg-image padding-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner d-flex align-items-center">
                        <h3 class="title mb-0">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_title')}}</h3>
                        <div class="btn-wrapper mt-0">
                            <a href="{{get_static_option('home_page_01_cta_area_button_url')}}"
                               class="boxed-btn">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_button_title')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(get_static_option('home_page_testimonial_section_status')))
    <section class="testimonial-area bg-image padding-top-110">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center padding-bottom-20">
                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_testimonial_section_title')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10">
                        <div class="testimonial-carousel-02">
                            @foreach($all_testimonial as $data)
                                <div class="single-testimonial-item-02">
                                    <div class="content">
                                        <div class="content-wrapper">
                                            <p class="description">{{$data->description}}</p>
                                            <div class="icon">
                                                <i class="flaticon-right-quote-1"></i>
                                            </div>
                                        </div>
                                        <div class="author-details">
                                            <div class="thumb">
                                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                            </div>
                                            <div class="author-meta">
                                                <h4 class="title">{{$data->name}}</h4>
                                                <span class="designation">{{$data->designation}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

{{--@if(!empty(get_static_option('home_page_testimonial_section_status')))--}}
{{--    <section class="testimonial-area bg-image padding-top-85 padding-bottom-40">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="section-title desktop-center padding-bottom-20">--}}
{{--                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_testimonial_section_title')}}</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="testimonial-carousel-area margin-top-10">--}}
{{--                        <div class="testimonial-carousel">--}}
{{--                            @foreach($all_testimonial as $data)--}}
{{--                                <div class="single-testimonial-item">--}}
{{--                                    <div class="content">--}}
{{--                                        <div class="thumb">--}}
{{--                                            {!! render_image_markup_by_attachment_id($data->image) !!}--}}
{{--                                        </div>--}}
{{--                                        <p class="description">{{$data->description}}</p>--}}
{{--                                        <div class="icon">--}}
{{--                                            <i class="flaticon-right-quote-1"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="author-details">--}}
{{--                                            <div class="author-meta">--}}
{{--                                                <h4 class="title">{{$data->name}}</h4>--}}
{{--                                                <span class="designation">{{$data->designation}}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endif--}}

@if(!empty(get_static_option('home_page_price_plan_section_status')))
    <section class="pricing-plan-area bg-image price-inner padding-bottom-100 margin-top-70 padding-top-100"
            {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_01_price_plan_background_image')) !!}>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title white desktop-center padding-bottom-55">
                        <h3 class="mb-0 title">{{get_static_option('home_page_01_'.$user_select_lang_slug.'_price_plan_section_title')}}</h3>
                        <p>{{get_static_option('home_page_01_'.$user_select_lang_slug.'_price_plan_section_description')}} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="price-plan-slider">
                        @foreach($all_price_plan as $data)
                            <div class="single-price-plan-01 @if(!empty($data->highlight)) style-03 active @endif">
                                <div class="price-header">
                                    <div class="name-box">
                                        <h4 class="name">{{$data->title}}</h4>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price">{{amount_with_currency_symbol($data->price)}}</span><span
                                                class="month">{{$data->type}}</span>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <ul>
                                        @php
                                            $features = explode("\n",$data->features);
                                        @endphp
                                        @foreach($features as $item)
                                            <li>{{$item}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-wrapper">
                                    @php
                                        $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                    @endphp
                                    <a href="{{$url}}" class="boxed-btn">{{$data->btn_text}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if(!empty(get_static_option('home_page_brand_logo_section_status')))
    <div class="client-section  background-gray-light-lightest padding-bottom-70 padding-top-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area">
                            @foreach($all_brand_logo as $data)
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        @if(!empty($data->url) )<a href="{{$data->url}}">@endif
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                            @if(!empty($data->url) )  </a>@endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@include('frontend.partials.contact-section')
