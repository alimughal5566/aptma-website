@extends('frontend.frontend-page-master')
@section('site-title',' Daily Economics')
@section('page-title')
    Daily Economics
@endsection

@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section class="service-area service-page common-area circular-area circular-page padding-top-40 padding-bottom-60">
        <div class="container">
            <h2 class="font-weight-bold mb-3 text-center">
                Daily Economics <?php echo ($category) ? "<small>($category->name)</small>" : "" ?></h2>

            <div class="row">
                @forelse($all_services as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="common-item circular-item single-what-we-cover-item-02 margin-bottom-30">
                            <div class="common-img circular-img single-what-img position-relative">
                                @php
                                    $now = Carbon\Carbon::now();
                                $datework = Carbon\Carbon::parse($data->created_at);
                                $diff = $datework->diffInDays($now);
                                @endphp
                                @if($diff<15)
                                    <small class="font-italic badge">New</small>
                                @endif
{{--                                $pdf = \PDF::loadView('pdf.invoice', $data);--}}

{{--                                <img src="{{$pdf}}"></img>--}}
{{--                                <a href="{{route('frontend.circular.single',$data->slug)}}">{!! render_image_markup_by_attachment_id($pdf) !!}</a>--}}
                            </div>
                            <div class="common-content content">
                                <a href="{{route('frontend.economic.single',$data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <p>{{@$data->category->name}}</p>
                                <p>{{@$data->publish_date}}</p>
{{--                                <a href="{{asset('assets/uploads/daily-economics/'.$data->url)}}" download target="_blank" class="btn">Download</a>--}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 card border-0 thumb margin-bottom-40">
                        <div class="text center px-5 card-body ">
                            <h1 class="text-muted">Sorry,No data found</h1>
                        </div>
                    </div>
                @endforelse
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_services->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
