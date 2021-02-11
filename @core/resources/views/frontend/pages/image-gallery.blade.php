@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <style>
        .hover-disable:hover{
            cursor: default;
        }


    </style>
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01">
                            <li class="active" data-filter="*">{{__('Categories')}}</li>
                            {{--                           @foreach($all_category as $data)--}}
                            {{--                               <li data-filter=".{{Str::slug($data->title)}}">{{$data->title}}</li>--}}
                            {{--                           @endforeach--}}
                        </ul>
                        <div class="case-studies-masonry">
                            {{--                           @foreach($all_gallery_images as $data)--}}
                            {{--                               <div class="col-lg-4 col-md-6 masonry-item {{Str::slug(get_image_category_name_by_id($data->cat_id))}}">--}}
                            {{--                                   <div class="single-gallery-image ">--}}
                            {{--                                       @php--}}
                            {{--                                           $gallery_img = get_attachment_image_by_id($data->image,'full',false);--}}
                            {{--                                           $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';--}}
                            {{--                                       @endphp--}}
                            {{--                                       {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}--}}
                            {{--                                       <div class="img-hover">--}}
                            {{--                                           <a href="{{$img_url}}" title="{{$data->title}}" class="image-popup">--}}
                            {{--                                               <i class="fas fa-search"></i>--}}
                            {{--                                           </a>--}}
                            {{--                                       </div>--}}
                            {{--                                   </div>--}}
                            {{--                               </div>--}}
                            {{--                           @endforeach--}}
                            @foreach($all_categories as $data)
                                <div class="col-lg-4 col-md-6 masonry-item">
                                    <div class="single-gallery-image @if($data->images->count()==0) hover-disable @endif">
                                        @php
                                            $gallery_img = get_attachment_image_by_id($data->image,'full',false);
                                            $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';
                                        @endphp
                                        {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                        <div class="img-hover">
                                            <div @if($data->images->count()>0) data-toggle="modal" data-target=".modalSlider" @endif>
                                                <a title="{{$data->title}}"   >
                                                    <i class="fas fa-eye"></i>
                                                    <span>{{$data->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($data->images->count()>1)
                                <div class="modal modalSlider">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                            <!-- Modal body -->
                                            <div class="modal-body">

                                                <div class="slider-carousel-wrapper">
                                                <div class="slider-grid-carousel">
                                                    @foreach($data->images as $image)
                                                        <div class="slider-grid">

                                                            <div class="slider-image w-100 h-100">
                                                                @php $image_url = asset('assets/uploads/media-uploader/large-'.$image->get_image->path) @endphp
                                                                <img alt="{{$image->title}}" src="{{$image_url}}" >
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
                        @endforeach

                        <!-- The Modal -->



                        </div>
                    </div>
                    <div class="blog-pagination">
                        {!! $all_gallery_images->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        // $('.image-popup').magnificPopup({
        //     type: 'image',
        //     gallery: {
        //         enabled: true
        //     },
        // });

    </script>
@endsection