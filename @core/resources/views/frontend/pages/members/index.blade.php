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
    Teams
@endsection
@section('page-title')
    Teams
@endsection
@section('content')

    <div class="page-content service-details common-single teams-group padding-top-50 padding-bottom-80 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="font-weight-bold mb-3 text-center">
                        {{ucfirst($zone->name)}} Members
                    </h2>
                </div>
                <div class="col-12">

                    <div class="table-responsive ">
                        <table class="table table-striped">
                            <thead>
                            <tr class="px-3 py-2 background-primary2 text-center text-white font-weight-bold">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Fax</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $team)
                                <tr>
                                    <td>{{$team->name}}</td>
                                    <td>{{$team->email}}</td>
                                    <td>{{$team->phone}}</td>
                                    <td>{{$team->fax}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="text-right float-right pt-3">
                        {!! $users->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
