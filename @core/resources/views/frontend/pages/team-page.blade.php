@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('team_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('team_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('team_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('team_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <div class="team-member-area team-page padding-50 background-gray-light-lightest">
        <div class="container">
            <h2 class="font-weight-bold mb-3 text-center">
                Team <?php echo ($category) ? "<small>($category)</small>" : "" ?></h2>
            <div class="row">
                <div class="col-12">
                    @forelse($data as $record)
                        @if($record['members']->count()>0)
                            <div class="row">
                                <div class="col-12 padding-bottom-30">
                                    <h3 class="subtitle"> {{$record['name']}}</h3>
                                </div>
                                @foreach($record['members'] as $user )
                                    <div class="col-lg-3 col-sm-6 padding-bottom-50">
                                        <div class="team-section">
                                            {{--                            <div class="team-img-cont" onclick="detail({{$user}});">--}}
                                            <div class="team-img-cont" style="cursor:default;">
                                                <a href="{{route('frontend.team.member',$user->id) }}">
                                                    {!! render_image_markup_by_attachment_id($user->image) !!}
                                                </a>
                                            </div>
                                            <div class="team-text">
                                                <a href="{{route('frontend.team.member',$user->id) }}">
                                                    <h4 class="title">{{$user->name}}</h4>
                                                    <span>{{$user->designation}}</span>
                                                </a>

                                                <div class="social-link">
                                                    <ul>
                                                        @if(!empty($user->icon_one) && !empty($user->icon_one_url))
                                                            <li>
                                                                <a href="{{$user->icon_one_url}}">
                                                                    <i class="{{$user->icon_one}}"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($user->icon_two) && !empty($user->icon_two_url))
                                                            <li>
                                                                <a href="{{$user->icon_two_url}}">
                                                                    <i class="{{$user->icon_two}}"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($user->icon_three) && !empty($user->icon_three_url))
                                                            <li>
                                                                <a href="{{$user->icon_three_url}}">
                                                                    <i class="{{$user->icon_three}}"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @empty
                        <div class="col-12 card border-0 mt-5 margin-bottom-40">
                            <div class="text center px-5">
                                <h1 class="text-muted">Sorry, No member found</h1>
                            </div>
                        </div>
                    @endforelse

                    {{--                <div class="col-lg-12">--}}
                    {{--                    <div class="pagination-wrapper">--}}
                    {{--                                                {{$all_team_members->links()}}--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection
