@extends('frontend.frontend-page-master')
@section('site-title',$category->title)

@section('page-meta-data')
    <meta name="description"
          content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <style>
        .hover-disable:hover {
            cursor: default;
        }
    </style>
    <div class="contact-section padding-100">
        <div class="container">

            <div class="case-studies-masonry-wrapper">
                <div class="case-studies-menu style-01">
                    <h2 class="font-weight-bold mb-3 text-center">
                        Gallery <?php echo ($category) ? "<small>($category->title)</small>" : "" ?>
                    </h2>
                </div>
                
                <div class="case-studies-masonry">
                    @foreach($all_gallery_images as $data)
                        <div class="col-lg-4 col-md-6 masonry-item {{Str::slug(get_image_category_name_by_id($data->cat_id))}}">
                            <div class="single-gallery-image ">
                                @php
                                    $gallery_img = get_attachment_image_by_id($data->image,'full',false);
                                    $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';
                                @endphp
                                <a href="{{$img_url}}" title="{{$data->title}}" class="image-popup ">
                                    {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    <div class="img-hover">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


@endsection