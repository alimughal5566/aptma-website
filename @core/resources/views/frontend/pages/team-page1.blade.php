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

    <div class="team-member-area team-page padding-50 bg-white">
        <div class="container">
            <h2 class="font-weight-bold mb-3 text-center">
                Team <?php echo ($category) ? "<small>($category)</small>" : "" ?></h2>
            <div class="row">
                @forelse($all_team_members as $data)
                    <div class="col-lg-3  col-sm-6 padding-bottom-50 ">
                        <div class="team-section">
                            <div class="team-img-cont" onclick="detail({{$data}});">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                            </div>
                            <div class="team-text">
                                <h4 class="title">{{$data->name}}</h4>
                                <span>{{$data->designation}}</span>
                                <div class="social-link">
                                    <ul>
                                        @if(!empty($data->icon_one) && !empty($data->icon_one_url))
                                            <li>
                                                <a href="{{$data->icon_one_url}}">
                                                    <i class="{{$data->icon_one}}"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($data->icon_two) && !empty($data->icon_two_url))
                                            <li>
                                                <a href="{{$data->icon_two_url}}">
                                                    <i class="{{$data->icon_two}}"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(!empty($data->icon_three) && !empty($data->icon_three_url))
                                            <li>
                                                <a href="{{$data->icon_three_url}}">
                                                    <i class="{{$data->icon_three}}"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 card border-0  gray-bg mt-5 margin-bottom-40">
                        <div class="text center px-5">
                            <h1 class="text-muted">Sorry, No member found</h1>
                        </div>
                    </div>
                @endforelse

                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_team_members->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailModal" style="z-index: 99999">
            <div class="modal-dialog modal-xl modal-center">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="team-detail-wrapper d-flex flex-column ">
                                    <div class="team-detail-item d-flex align-items-start flex-column flex-lg-row">
                                        <div class="team-label">
                                            <strong>Designation </strong>
                                        </div>
                                        <div class="team-detail designation">
                                        </div>
                                    </div>
                                    <div class="team-detail-item d-flex align-items-start flex-column flex-lg-row">
                                        <div class="team-label">
                                            <strong>About me </strong>
                                        </div>
                                        <div class="team-detail about-me">
                                        </div>
                                    </div>
                                    <div class="team-detail-item d-flex align-items-start flex-column flex-lg-row">
                                        <div class="team-label">
                                            <strong> </strong>
                                        </div>
                                        <div class="team-detail descriptionn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    {{--                                <div class="modal-footer">--}}
                    {{--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">back</button>--}}
                    {{--                                </div>--}}

                </div>
            </div>
        </div>

    </div>

    <script>
        function detail(detail) {
            // alert(detail.description);
            $('.designation').text(detail.designation);
            $('.modal-title').text(detail.name + ' Profile');
            $('.descriptionn').html(detail.description);
            $('.about-me').html(detail.about_me);
            $('#detailModal').modal()
        }
    </script>
@endsection