@extends('frontend.frontend-page-master')
@section('og-meta')
    {{--    <meta property="og:url" content="{{route('frontend.services.single',$service_item->id)}}"/>--}}
    <meta property="og:type" content="article"/>
    {{--    <meta property="og:title" content="{{$service_item->title}}"/>--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection
@section('meta-tags')
    {{--    <meta name="description" content="{{$service_item->meta_description}}">--}}
    {{--    <meta name="tags" content="{{$service_item->meta_tag}}">--}}
    {{--    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}--}}
@endsection
@section('site-title')
    'Teams'
@endsection
@section('page-title')
    'Teams'
@endsection
@section('content')

    <div class="page-content service-details common-single teams-group padding-top-50 padding-bottom-80 ">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold mb-3 text-center">
                        Our Teams
                    </h2>
                </div>

                @forelse($teams as $team)
                    <div class="col-lg-3  col-sm-6  mb-5 ">
                        <div class="team-section p-2 ">
                            <div class="team-img-cont">
                                <a href="{{route('frontend.team',$team->id) }}">
                                    {!! render_image_markup_by_attachment_id($team->img_id) !!}
                                </a>
                            </div>
                            <hr>
                            <div class="team-text">
                                <a href="{{route('frontend.team',$team->id) }}">
                                    <h4 class="title">{{$team->name}}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 card border-0  gray-bg mt-5 margin-bottom-40">
                        <div class="text center px-5">
                            <h1 class="text-muted">Sorry, No team found</h1>
                        </div>
                    </div>
                @endforelse

                {{--                <div class="col-lg-12">--}}
                {{--                    <div class="pagination-wrapper">--}}
                {{--                        {{$all_team_members->links()}}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
@endsection
