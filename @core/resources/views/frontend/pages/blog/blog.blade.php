@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('blog_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('blog_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')

    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach($all_blogs as $data)
                        <div class="blog-classic-item-01 margin-bottom-40">
                            <div class="thumbnail">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li>
                                        <a href="{{route('frontend.blog.single',$data->slug)}}">
                                            <span class="d-flex align-items-center author ">
                                                <i class="fa fa-user mr-1"></i>
                                                <span>{{$data->author}}</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('frontend.blog.single',$data->slug)}}">
                                            <span class="d-flex align-items-center date ">
                                                <i class="far fa-clock mr-1"></i>
                                                <span>{{date_format($data->created_at,'d M y')}}</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <span class="d-flex align-items-center cats ">
                                            <i class="fas fa-microchip mr-1"></i>
                                            <span>{!! get_blog_category_by_id($data->blog_categories_id,'link') !!}</span>
                                        </span>
                                    </li>
                                </ul>
                                <h4 class="title"><a
                                            href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a>
                                </h4>
                                <p>{{$data->excerpt}}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.blog.single',$data->slug)}}"
                                       class="boxed-btn reverse-color">{{get_static_option('blog_page_'.$user_select_lang_slug.'_read_more_btn_text')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <nav class="pagination-wrapper" aria-label="Page navigation ">
                        {{$all_blogs->links()}}
                    </nav>
                </div>
                <div class="col-lg-4">
                    @include('frontend.pages.blog.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
