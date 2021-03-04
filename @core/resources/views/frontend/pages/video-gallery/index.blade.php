@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    Videos
@endsection
@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')

    <section class="service-area service-page common-area video-area publication-page padding-top-40 padding-bottom-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold mb-3 text-center">
                        Videos <?php echo ($category) ? "<small>($category->name)</small>" : "" ?>
                    </h2>
                </div>

                @forelse($all_services as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="common-item single-what-we-cover-item-02 margin-bottom-30">
                            <div class="common-img single-what-img ">
                                @php
                                    $now = Carbon\Carbon::now();
                                    $datework = Carbon\Carbon::parse($data->created_at);
                                    $diff = $datework->diffInDays($now); @endphp
                                @if($diff<15)
                                    <small class=" font-italic badge">New</small>
                                @endif
                                <a href="{{$data->url}}" target="_blank">
                                    {!! render_image_markup_by_attachment_id($data->thumbnail) !!}
                                </a>
                            </div>
                            <div class="common-content content">
                                <a href="{{route('frontend.gallery.video.single', $data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
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

            </div>
        </div>
    </section>
@endsection
