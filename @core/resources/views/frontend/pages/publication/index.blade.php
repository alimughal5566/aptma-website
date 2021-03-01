@extends('frontend.frontend-page-master')
@section('site-title','Articles & Publications')

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
                Publications <?php echo ($category) ? "<small>($category->name)</small>" : "" ?></h2>

            <div class="row">
                @php $a = 1; @endphp
                @forelse($all_services as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="common-item publication-item single-what-we-cover-item-02 margin-bottom-30">
                            <div class="common-img publication-img single-what-img position-relative">
                                @php
                                    $now = Carbon\Carbon::now();
                                    $datework = Carbon\Carbon::parse($data->created_at);
                                    $diff = $datework->diffInDays($now);
                                @endphp
                                @if($diff<15)
                                    <small class="font-italic badge ">New</small>
                                @endif
                                <a href="{{route('frontend.publication.single',$data->slug)}}">
                                    {!! render_image_markup_by_attachment_id($data->thumbnail) !!}
                                </a>
                            </div>
                            <div class="common-content content">
                                <p class="">
                                    <span>{{date('M d Y', strtotime(@$data->publish_date))}}</span>
                                </p>
                                <a href="{{route('frontend.publication.single',$data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <a href="{{asset('assets/uploads/publications/pdf/'.$data->pdf_url)}}" target="_blank"
                                   class="btn text-center">Download</a>
                            </div>
                        </div>
                    </div>
                    @php
                        if($a == 4){ $a = 1;}else{$a++;};
                    @endphp
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
