<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo" style="max-height: 50px;">
            <a href="{{route('admin.home')}}">
                @php
                    $logo_type = 'site_logo';
                    if(!empty(get_static_option('site_admin_dark_mode'))){
                        $logo_type = 'site_white_logo';
                    }
                @endphp
                {!! render_image_markup_by_attachment_id(get_static_option($logo_type)) !!}
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav id="main_menu_wrap">
                <ul class="metismenu" id="menu">
                    <li class="{{active_menu('admin-home')}}">
                        <a href="{{route('admin.home')}}"
                           aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>@lang('dashboard')</span>
                        </a>
                    </li>
                    @if(check_page_permission_by_string('Users Manage'))
                        <li
                                class="main_dropdown {{active_menu('admin-home/frontend/new-user')}}
                                {{active_menu('admin-home/frontend/all-user')}}
                                {{active_menu('admin-home/frontend/all-user/role')}}
                                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                                <span>{{__('Users Manage')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/frontend/all-user')}}"><a
                                            href="{{route('admin.all.frontend.user')}}">{{__('All Users')}}</a></li>
                                <li class="{{active_menu('admin-home/frontend/new-user')}}"><a
                                            href="{{route('admin.frontend.new.user')}}">{{__('Add New User')}}</a></li>
                                {{--                            <li class="{{active_menu('frontend/import-user-view')}}"><a--}}
                                {{--                                    href="{{route('admin.frontend.import.users.view')}}">{{__('Import User')}}</a></li>--}}
                            </ul>
                        </li>
                    @endif
                    <li class="main_dropdown
                        {{active_menu('admin-home/publication-page')}}
                    @if(request()->is('admin-home/publication-page/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('publications')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/publication-page')}}">
                                <a href="{{route('admin.publications.all')}}">{{__('Publications')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/publication-page/category')}}">
                                <a href="{{route('admin.publication.category')}}">{{__('Category')}}</a>
                            </li>
                            {{--                            <li class="{{active_menu('admin-home/publication-page/page-settings')}}">--}}
                            {{--                                <a href="{{route('admin.gallery.page.settings')}}" >{{__('Page Settings')}}</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="main_dropdown
                        {{active_menu('admin-home/exchange-rates')}}
                    @if(request()->is('admin-home/exchange-rates/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Exchange Rates')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/exchange-rates')}}">
                                <a href="{{route('admin.exchnage.all')}}">{{__('Exchange Rates')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/exchange-rates/category')}}">
                                <a href="{{route('admin.exchnage.category')}}">{{__('Category')}}</a>
                            </li>
                            {{--                            <li class="{{active_menu('admin-home/publication-page/page-settings')}}">--}}
                            {{--                                <a href="{{route('admin.gallery.page.settings')}}" >{{__('Page Settings')}}</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="main_dropdown
                        {{active_menu('admin-home/video-page')}}
                    @if(request()->is('admin-home/video-page/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Gallery Videos')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/video-page')}}">
                                <a href="{{route('admin.gallery.video.all')}}">{{__('Videos')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/video-page/category')}}">
                                <a href="{{route('admin.gallery.video.category')}}">{{__('Category')}}</a>
                            </li>
                        </ul>
                    </li>

                    {{--                    <li class="main_dropdown--}}
                    {{--                        {{active_menu('admin-home/book')}}--}}
                    {{--                    @if(request()->is('admin-home/book/*')) active @endif--}}
                    {{--                            ">--}}
                    {{--                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>--}}
                    {{--                            <span>{{__('Books')}}</span></a>--}}
                    {{--                        <ul class="collapse">--}}
                    {{--                            <li class="{{active_menu('admin-home/book')}}">--}}
                    {{--                                <a href="{{route('admin.book.all')}}" >{{__('Books')}}</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="{{active_menu('admin-home/book/category')}}">--}}
                    {{--                                <a href="{{route('admin.book.category')}}" >{{__('Books Category')}}</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}
                    <li class="main_dropdown
                        {{active_menu('admin-home/circular')}}
                    @if(request()->is('admin-home/circular/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Circular')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/circular')}}">
                                <a href="{{route('admin.circular.all')}}">{{__('Circulars')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/circular/category')}}">
                                <a href="{{route('admin.circular.category')}}">{{__('Circular Category')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/circular/sub-category')}}">
                                <a href="{{route('admin.circular.sub-category')}}">{{__('Circular Sub Category')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="main_dropdown
                        {{active_menu('admin-home/daily-economic-update')}}
                    @if(request()->is('admin-home/daily-economic-update/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Economic Update')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/daily-economic-update')}}">
                                <a href="{{route('admin.daily.economic.update.all')}}">{{__('Daily Economic Update')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/daily-economic-update/category')}}">
                                <a href="{{route('admin.daily.economic.update.category')}}">{{__('Categories')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="main_dropdown
                        {{active_menu('admin-home/advertisement')}}
                    @if(request()->is('admin-home/advertisement/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Advertisement')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/advertisement')}}">
                                <a href="{{route('admin.advertisement.all')}}">{{__('Advertisement')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/advertisement/category')}}">
                                <a href="{{route('admin.advertisement.category')}}">{{__('Advertisement Category')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="main_dropdown
                        {{active_menu('admin-home/advertisement')}}
                    @if(request()->is('admin-home/advertisement/*')) active @endif
                            ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Statistics')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/advertisement')}}">
                                <a href="{{route('admin.statistics.index')}}">{{__('Index')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/advertisement/category')}}">
                                <a href="{{route('admin.statistics.categories.index')}}">{{__('Category')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/advertisement/category')}}">
                                <a href="{{route('admin.statistics.sub_categories.index')}}">{{__('Sub Category')}}</a>
                            </li>
                        </ul>
                    </li>

                    @if(check_page_permission_by_string('Gallery Page'))
                        <li class="main_dropdown
                        {{active_menu('admin-home/gallery-page')}}
                        @if(request()->is('admin-home/gallery-page/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Image Gallery')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/gallery-page')}}">
                                    <a href="{{route('admin.gallery.all')}}">{{__('Image Gallery')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/gallery-page/category')}}">
                                    <a href="{{route('admin.gallery.category')}}">{{__('Category')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('Team Members'))

                        <li class="main_dropdown
                        {{active_menu('admin-home/team-member')}}
                        @if(request()->is('admin-home/team-member/*') || request()->is('admin-home/team/*')|| request()->is('admin-home/team-types')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Team')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/team-member')}}">
                                    <a href="{{route('admin.team.member')}}">{{__('Team Members')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/team-member/category')}}">
                                    <a href="{{route('admin.team.category')}}">{{__('Teams')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/team/department')}}">
                                    <a href="{{route('admin.department.category')}}">{{__('Team Department')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/team-types')}}">
                                    <a href="{{route('admin.team.type.category')}}">{{__('Team Type')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

{{--                    @if(check_page_permission_by_string('Widgets Manage'))--}}
{{--                    <li--}}
{{--                        class="main_dropdown--}}
{{--                        {{active_menu('admin-home/widgets')}}--}}
{{--                        @if(request()->is('admin-home/widgets/*')) active @endif--}}
{{--                            ">--}}
{{--                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>--}}
{{--                            <span>{{__('Widgets Manage')}}</span></a>--}}
{{--                        <ul class="collapse">--}}
{{--                            <li class="{{active_menu('admin-home/widgets')}}"><a--}}
{{--                                    href="{{route('admin.widgets')}}">{{__('All Widgets')}}</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    @endif--}}

                    @if(check_page_permission_by_string('Blogs Manage'))
                        <li
                                class="main_dropdown
                        {{active_menu('admin-home/blog')}}
                                @if(request()->is('admin-home/blog/*')) active @endif
                                        "
                        >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Blogs')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/blog')}}"><a
                                            href="{{route('admin.blog')}}">{{__('All Blog')}}</a></li>
                                <li class="{{active_menu('admin-home/blog/category')}}"><a
                                            href="{{route('admin.blog.category')}}">{{__('Category')}}</a></li>
                                <li class="{{active_menu('admin-home/new-blog')}}"><a
                                            href="{{route('admin.blog.new')}}">{{__('Add New Post')}}</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status')))
                        <li
                                class="main_dropdown
                        {{active_menu('admin-home/jobs')}}
                                @if(request()->is('admin-home/jobs/*')) active @endif
                                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Job Post Manage')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/jobs')}}"><a
                                            href="{{route('admin.jobs.all')}}">{{__('All Jobs')}}</a></li>
                                <li class="{{active_menu('admin-home/jobs/category')}}"><a
                                            href="{{route('admin.jobs.category.all')}}">{{__('Category')}}</a></li>
                                <li class="{{active_menu('admin-home/new-jobs')}}"><a
                                            href="{{route('admin.jobs.new')}}">{{__('Add New Job')}}</a></li>
                                <li class="{{active_menu('admin-home/jobs/page-settings')}}"><a
                                            href="{{route('admin.jobs.page.settings')}}">{{__('Job Page Settings')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/jobs/single-page-settings')}}"><a
                                            href="{{route('admin.jobs.single.page.settings')}}">{{__('Job Single Page Settings')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/jobs/success-page-settings')}}">
                                    <a href="{{route('admin.jobs.success.page.settings')}}">{{__('Job Success Page Settings')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/jobs/cancel-page-settings')}}">
                                    <a href="{{route('admin.jobs.cancel.page.settings')}}">{{__('Job Cancel Page Settings')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/jobs/applicant')}}"><a
                                            href="{{route('admin.jobs.applicant')}}">{{__('All Applicant')}}</a></li>
                                <li class="{{active_menu('admin-home/jobs/applicant/report')}}"><a
                                            href="{{route('admin.jobs.applicant.report')}}">{{__('Applicant Report')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status')))
                        <li class="main_dropdown
                    {{active_menu('admin-home/events')}}
                        @if(request()->is('admin-home/events/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Events Manage')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/events')}}"><a
                                            href="{{route('admin.events.all')}}">{{__('All Events')}}</a></li>
                                <li class="{{active_menu('admin-home/events/category')}}"><a
                                            href="{{route('admin.events.category.all')}}">{{__('Category')}}</a></li>
                                <li class="{{active_menu('admin-home/events/new')}}"><a
                                            href="{{route('admin.events.new')}}">{{__('Add New Event')}}</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission('about_page_manage'))
                        <li class="main_dropdown @if(request()->is('admin-home/about-page/*')  ) active @endif ">
                            <a href="javascript:void(0)"
                               aria-expanded="true">
                                <i class="ti-home"></i>
                                <span>{{__('About Page Manage')}}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/about-page/about-us')}}"><a
                                            href="{{route('admin.about.page.about')}}">{{__('About Us Section')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/about-page/global-network')}}"><a
                                            href="{{route('admin.about.global.network')}}">{{__('Global Network Section')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/about-page/experience')}}"><a
                                            href="{{route('admin.about.experience')}}">{{__('Experience Section')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/about-page/team-member')}}"><a
                                            href="{{route('admin.about.team.member')}}">{{__('Team Member Section')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/about-page/testimonial')}}"><a
                                            href="{{route('admin.about.testimonial')}}">{{__('Testimonial Section')}}</a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('Contact Page Manage'))
                        <li class="main_dropdown @if(request()->is('admin-home/contact-page/*')  ) active @endif">
                            <a href="javascript:void(0)"
                               aria-expanded="true">
                                <i class="ti-home"></i>
                                <span>{{__('Contact Page Manage')}}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/contact-page/contact-info')}}">
                                    <a href="{{route('admin.contact.info')}}">{{__('Contact Info')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/contact-page/form-area')}}">
                                    <a href="{{route('admin.contact.page.form.area')}}">{{__('Form Area')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/contact-page/map')}}">
                                    <a href="{{route('admin.contact.page.map')}}">{{__('Google Map Area')}}</a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    @if(!empty(get_static_option('site_maintenance_mode')))
                        <li class="main_dropdown {{active_menu('admin-home/maintains-page/settings')}}">
                            <a href="{{route('admin.maintains.page.settings')}}"
                               aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span>{{__('Maintain Page Manage')}}</span>
                            </a>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('General Settings'))
                        <li class="main_dropdown @if(request()->is('admin-home/general-settings/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                                <span>{{__('General Settings')}}</span></a>
                            <ul class="collapse ">
                                <li class="{{active_menu('admin-home/general-settings/site-identity')}}"><a
                                            href="{{route('admin.general.site.identity')}}">{{__('Site Identity')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/general-settings/basic-settings')}}"><a
                                            href="{{route('admin.general.basic.settings')}}">{{__('Basic Settings')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/general-settings/email-template')}}"><a
                                            href="{{route('admin.general.email.template')}}">{{__('Email Template')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
