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
        .hover-disable:hover {
            cursor: default;
        }
    </style>
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01">
                            <h2 class="font-weight-bold mb-3 text-center">
                                Gallery <?php echo ($category) ? "<small>($category->title)<small>" : "" ?></h2>
                        </ul>
                        <div class="case-studies-masonry">
                            <div class="row">
                                @forelse($all_categories as $data)
                                    <div class="col-lg-4 col-md-6 masonry-item p-1">
                                        <div class="single-gallery-image  hover-disable d-flex d-inline">
                                            {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                        </div>
                                    </div>
                            </div>
                            @empty
                                <div class="col-md-12 card border-0  margin-bottom-40">
                                    <div class="text center px-5">
                                        <h1 class="text-muted">Sorry, No image found</h1>
                                    </div>
                                </div>
                            @endforelse
                        </div>
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