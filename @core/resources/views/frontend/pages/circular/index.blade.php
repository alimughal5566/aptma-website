@extends('frontend.frontend-page-master')
@section('site-title','Circulars')
@section('page-title')
    Circulars
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
                Circulars <?php echo ($category) ? "<small>($category->name)</small>" : "" ?>
            </h2>

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
                                <a href="{{route('frontend.circular.single',$data->slug)}}">{!! render_image_markup_by_attachment_id($data->thumbnail) !!}</a>
                            </div>
                            <div class="common-content content">
                                <a href="{{route('frontend.circular.single',$data->slug)}}">
                                    <h4 class="title mb-0">{{$data->title}}</h4>
                                </a>
                                <p>{{@$data->category->name}}</p>
                                <p>
                                    <span>{{date('M d Y', strtotime(@$data->publish_date))}}</span>
                                </p>
                                <a href="{{asset('assets/uploads/circular/'.$data->url)}}" download target="_blank" class="btn">Download</a>
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
