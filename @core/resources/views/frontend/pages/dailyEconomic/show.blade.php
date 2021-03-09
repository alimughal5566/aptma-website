@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:url" content="{{route('frontend.services.single',$service_item->id)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$service_item->title}}"/>
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('meta-tags')
    <meta name="description" content="{{$service_item->meta_description}}">
    <meta name="tags" content="{{$service_item->meta_tag}}">
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('site-title')
    {{$service_item->title}} -  {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{$service_item->title}}
@endsection
@section('content')


    <div class="page-content service-details common-single circular-single padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="common-single-title circular-single-title margin-bottom-15">{{$service_item->title}}</h3>
                </div>

                <div class="col-lg-12">
                    <div class="service-details-item common-single-item circular-single-item position-relative">
                        <a href="{{asset('assets/uploads/daily-economics/'.$service_item->url)}}" download
                           class="btn">Download</a>
                        {{--                        <div class="thumb">--}}
                        {{--                            {!! render_image_markup_by_attachment_id($service_item->thumbnail) !!}--}}
                        {{--                        </div>--}}
                    </div>
                    <embed type="application/pdf" frameborder="0" scrolling="no" showcontrols="false"
                           src="{{asset('assets/uploads/daily-economics/'.$service_item->url.'#embedded=true&page=1&toolbar=0&navpanes=0&scrollbar=0&view=fitH,100&zoom=100&view=Fit')}}"
                           height="800px" width="100%"/>
                </div>
<!--                --><?php //$pdfThumb = new imagick( 'test.jpg' );;
//                $pdfThumb->setResolution(10, 10);
//                $pdfThumb->readImage('http://localhost/aptma-website/assets/uploads/daily-economics/1614660385.pdf.png[0]');
//                $pdfThumb->setImageFormat('jpg');
//                header("Content-Type: image/jpeg");
//                echo $pdfThumb;
//                $fp = fopen('http://localhost/aptma-website/assets/uploads/daily-economics/1614660385.pdf.jpg', "x");
//                $pdfThumb->writeImageFile($fp);
//                fclose($fp);
//                ?>

                {{--                <div class="col-lg-6">--}}
                {{--                    <div class="service-details-item common-single-item circular-single-item position-relative">--}}
                {{--                        <div class="service-description common-single-description circular-description">--}}
                {{--                            <p class="margin-bottom-15">{{$service_item->category->name}}</p>--}}
                {{--                            <p>{{@$data->publish_date}}</p>--}}
                {{--                            <p>{!! $service_item->description !!}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>
@endsection

