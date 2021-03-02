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
                                <p class="font-weight-bold">{{@$data->subCategory->name}}</p>
                                {{--                                <p>--}}
                                {{--                                    <span>{{date('M d Y', strtotime(@$data->publish_date))}}</span>--}}
                                {{--                                </p>--}}
                                <div class="d-flex align-items-center">
                                    <a href="#" data-toggle="modal" data-target="#preview-modal"
                                       data-message="{{@$data->description}}">
                                        <i class="fa fa-eye fa-2x"></i>
                                    </a>
                                    <a href="{{asset('assets/uploads/circular/'.$data->url)}}" download target="_blank">
                                        <i class="fa fa-file-pdf fa-2x"></i>
                                    </a>
                                </div>
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
    <!-- Modal -->
    <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog"
         aria-labelledby="preview-modalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')

    <script>

        $('#preview-modal').on('show.bs.modal', function (event) {
            var myVal = $(event.relatedTarget);
            var val = myVal.data('message');
            $('.modal-body').html(val)
        });
    </script>

@endpush
