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
                        Our Members
                    </h2>
                </div>
                <div class="col-12">
                    @isset($teams)
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>

                            <th>Phone</th>

                            <th>Fax</th>
                            <th>Zone</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($teams as $team)
{{--                                @dd($team);--}}
                                <tr>
                                    <td>{{$team->name}}</td>
                                    <td>{{$team->email}}</td>
                                    <td>{{$team->phone}}</td>
                                    <td>{{$team->fax}}</td>
                                    <td>{{$team->zone->name}}</td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                    <div class="text-right float-right pt-1">
                    {!! $teams->render() !!}
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
