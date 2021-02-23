@if(!empty(get_static_option('preloader_status')))
    @php
        $preloader = 'preloader-default';
        if (!empty(get_static_option('preloader_custom'))){
            $preloader = 'preloader-custom';
        }elseif(empty(get_static_option('preloader_custom')) && !empty(get_static_option('preloader_default'))){
            $preloader = 'preloader-dynamic';
        }
    @endphp
    @include('frontend.partials.preloader.'.$preloader)
@endif
@include('frontend.partials.search-popup')

<div class="navigation-wrap">
    @if(!empty(get_static_option('home_page_support_bar_section_status')))
        <div class="top-bar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-bar-inner fixed">
                            <div class="left-content">
                                <ul class="social-icons">
                                    @foreach($all_social_item as $data)
                                        <li>
                                            <a href="{{$data->url}}">
                                                <i class="{{$data->icon}}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="right-content">
                                <ul>
                                    @if(auth()->check())
                                        @php
                                            $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                        @endphp
                                        <li>
                                            <a href="{{$route}}">{{__('Dashboard')}}</a> <span>/</span>
                                            <a href="{{ route('user.logout') }}"
                                               onclick="event.preventDefault();
                                                         document.getElementById('userlogout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{route('user.login')}}">{{__('Member Login')}}</a>
                                            {{--                                            <span>/</span>--}}
                                            {{--                                            <a href="{{route('user.register')}}">{{__('Register')}}</a>--}}
                                        </li>
                                    @endif
                                    @if(!empty(get_static_option('language_select_option')))
                                        <li>
                                            <select id="langchange">
                                                @foreach($all_language as $lang)
                                                    <option @if($user_select_lang_slug == $lang->slug) selected
                                                            @endif value="{{$lang->slug}}"
                                                            class="lang-option">{{$lang->name}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                    @endif
                                    {{--                                    @if(!empty(get_static_option('navbar_button')))--}}
                                    {{--                                        <li>--}}
                                    {{--                                            @php--}}
                                    {{--                                                $custom_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote');--}}
                                    {{--                                            @endphp--}}
                                    {{--                                            <div class="btn-wrapper">--}}
                                    {{--                                                <a href="{{$custom_url}}"--}}
                                    {{--                                                   @if(!empty(get_static_option('navbar_button_custom_url_status'))) target="_blank"--}}
                                    {{--                                                   @endif class="boxed-btn reverse-color">{{get_static_option('navbar_'.$user_select_lang_slug.'_button_text')}}</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </li>--}}
                                    {{--                                    @endif--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="header header-style-01  header-variant-{{get_static_option('home_page_variant')}}">
        <nav class="navbar navbar-area navbar-expand-lg nav-style-01">
            <div class="container-fluid nav-container">
                {{--                <div class="container-wrap">--}}
                <div class="order-1 order-lg-0 responsive-mobile-menu">
                    <div class="logo-wrapper">
                        <a href="{{url('/')}}" class="logo">
                            @if(!empty(get_static_option('site_white_logo')))
                                {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                            @else
                                <h2 class="site-title">{{get_static_option('site_'.$user_select_lang_slug.'_title')}}</h2>
                            @endif
                        </a>
                    </div>
                    @if(!empty(get_static_option('product_module_status')))
                        <div class="mobile-cart">
                            <a href="{{route('frontend.products.cart')}}">
                                <i class="flaticon-shopping-cart"></i>
                                <span class="pcount">{{cart_total_items()}}</span>
                            </a>
                        </div>
                    @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="order-3 order-lg-1 collapse navbar-collapse" id="bizcoxx_main_menu">
                    <ul class="navbar-nav">
                        <li>
                            <a href="{{url('/')}}">{{ __('Home') }}</a>
                        </li>

                        @php $dynamic_pages=\App\Page::where(['status' =>'publish','lang'=>'en'])->get(); @endphp

                        <li class=" menu-item-has-children ">
                            <a href="javascript:void(0);">About</a>
                            <ul class="sub-menu">
                                @if($dynamic_pages->count()>0)
                                    @foreach($dynamic_pages as $page)
                                        <li>
                                            <a href="{{route('frontend.dynamic.page',$page->slug)}}">{{$page->title}}</a>
                                        </li>
                                    @endforeach
                                @endif

                                {{--                                <li>--}}
                                {{--                                    <a href="javascript:void(0);">Patron in Chief message</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <a href="javascript:void(0);">Chairman Message</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <a href="javascript:void(0);">Executive Director</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="menu-item-has-children ">--}}
                                {{--                                    <a href="javascript:void(0);">Members of Executive Committees</a>--}}
                                {{--                                    <ul class="sub-menu">--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="javascript:void(0);">Executive Commitee</a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li>--}}
                                {{--                                            <a href="javascript:void(0);">Admin and Finance</a>--}}
                                {{--                                        </li>--}}
                                {{--                                        <li class="menu-item-has-children ">--}}
                                {{--                                            <a href="javascript:void(0);">Standing Committee</a>--}}
                                {{--                                            <ul class="sub-menu">--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">Cotton & Raw Material</a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">FBR</a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">Re-structure</a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">Energy</a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">Polyester, Fiber &amp; Synthetic fiber</a>--}}
                                {{--                                                <li>--}}
                                {{--                                                <li>--}}
                                {{--                                                    <a href="javascript:void(0);">Others</a>--}}
                                {{--                                                </li>--}}
                                {{--                                            </ul>--}}
                                {{--                                        </li>--}}
                                {{--                                    </ul>--}}
                                {{--                                </li>--}}

                                @php $teamCategory=\App\TeamCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp

                                <li class=" {{$teamCategory->count()>0 ? ' menu-item-has-children ' : ' '}} ">
                                    <a href="{{route('frontend.teams')}}">Team</a>
                                    @if($teamCategory->count()>0)
                                        <ul class="sub-menu">
                                            @foreach($teamCategory as $team)
                                                <li>
                                                    <a href="{{route('frontend.team',[$team->slug])}}">{{$team->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>

                            </ul>
                        </li>

                        @php $blogCategories=\App\BlogCategory::where(['status' =>'publish','lang'=>'en'])->withCount('blogs')->orderBy('id','desc')->get(); @endphp
                        @php $teamtypes=\App\TeamType::where(['status' =>'publish','lang'=>'en'])->whereHas('type_members')->orderby('order_no','asc')->get(); @endphp

                        <li class=" {{$blogCategories->count()>0 ? ' menu-item-has-children ' : ' '}} ">
                            <a href="javascript:void(0);">Research & Publications</a>
                            <ul class="sub-menu">
                                @foreach($teamtypes as $type)
                                <li>
                                    <a href="{{route('frontend.team.types',$type->slug)}}">{{$type->name}}</a>
                                </li>
                                @endforeach
                                @php $publicationCategories=\App\PublicationCategory::where(['status' =>'publish','lang'=>'en'])->withcount('publications')->orderBy('id','desc')->get(); @endphp

                                <li class=" {{$publicationCategories->count()>0 ? ' menu-item-has-children ' : ' '}} ">
                                    <a href="{{route('frontend.publication')}}">Articles &amp; Publications</a>
                                    @if($publicationCategories->count()>0)
                                        <ul class="sub-menu">
                                            @foreach($publicationCategories as $category)
                                                @if($category->publications_count>0)
                                                    <li>
                                                        <a href="{{route('frontend.publication',[$category->slug])}}">{{$category->name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>


                                {{--                                <li class=" {{$blogCategories->count()>0 ? ' menu-item-has-children ' : ' '}} ">--}}
                                {{--                                    <a href="{{route('frontend.blog')}}">Blogs & Articles</a>--}}

                                {{--                                    @if($blogCategories->count()>0)--}}
                                {{--                                        <ul class="sub-menu">--}}
                                {{--                                            @foreach($blogCategories as $category)--}}
                                {{--                                                @if($category->blogs_count>0)--}}
                                {{--                                                    <li>--}}
                                {{--                                                        <a href="{{route('frontend.blog.category', ['id' => $category->id,'any'=> Str::slug($category->name,'-')])}}">{{$category->name}}</a>--}}
                                {{--                                                    </li>--}}
                                {{--                                                @endif--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </ul>--}}
                                {{--                                    @endif--}}

                                {{--                                </li>--}}

                                {{--                                <li>--}}
                                {{--                                    <a href="javascript:void(0);">Policy Document</a>--}}
                                {{--                                </li>--}}

{{--                                                                @php $bookCategories=\App\BookCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp--}}

{{--                                                                <li class=" {{$bookCategories->count()>0 ? ' menu-item-has-children ' : ' '}} ">--}}
{{--                                                                    <a href="{{route('frontend.book.index')}}">Books</a>--}}
{{--                                                                    @if($bookCategories->count()>0)--}}
{{--                                                                        <ul class="sub-menu">--}}
{{--                                                                            @foreach($bookCategories as $category)--}}
{{--                                                                                <li>--}}
{{--                                                                                    <a href="{{route('frontend.book.index',[$category->slug])}}">{{$category->name}}</a>--}}
{{--                                                                                </li>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </ul>--}}
{{--                                                                    @endif--}}
{{--                                                                </li>--}}

                            </ul>
                        </li>

{{--                                                <li class=" menu-item-has-children ">--}}
{{--                                                    <a href="{{route('frontend.circular.index')}}">Circulars</a>--}}
{{--                                                    <ul class="sub-menu">--}}
{{--                                                        @php $categories=\App\CircularCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp--}}
{{--                                                        @if($categories->count()>0)--}}

{{--                                                            @foreach($categories as $category)--}}
{{--                                                                <li>--}}
{{--                                                                    <a href="{{route('frontend.circular.index',[$category->slug])}}">{{$category->name}}</a>--}}
{{--                                                                </li>--}}
{{--                                                            @endforeach()--}}

{{--                                                        @endif--}}
{{--                                                    </ul>--}}
{{--                                                </li>--}}

                        <li class=" menu-item-has-children ">
                            <a href="javascript:void(0);">Statistics</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0);">Cotton</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Production</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Exports</a>
                                </li>
                            </ul>
                        </li>

                        <li class=" menu-item-has-children">
                            <a href="javascript:void(0);">Members Directory</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0);">Members Pages</a>
                                </li>
                            </ul>
                        </li>

                        <li class=" menu-item-has-children ">
                            <a href="javascript:void(0);">Events</a>
                            <ul class="sub-menu">
                                @php $eventCategories= \App\EventsCategory::where(['status' =>'publish','lang'=>'en'])->withCount('events')->orderBy('id','desc')->get(); @endphp
                                <li class="  {{$eventCategories->count()>0 ? ' menu-item-has-children ' : ' '}} ">
                                    <a href="javascript:void(0);">APTMA Events</a>
                                    @if($eventCategories->count()>0)
                                        <ul class="sub-menu">
                                            @foreach($eventCategories as $category)
                                                @if($category->events_count>0)
                                                    <li>
                                                        <a href="{{route('frontend.events.category', ['id' => $category->id,'any'=> Str::slug($category->title,'-')])}}">{{$category->title}}</a>
                                                    </li>
                                                @endif
                                            @endforeach()
                                        </ul>
                                    @endif
                                </li>

                                @php $imageCategories= \App\ImageGalleryCategory::where(['status' =>'publish','lang'=>'en'])->withCount('images')->orderBy('id','desc')->get(); @endphp
                                @if($imageCategories->count()>0)
                                <li class=" {{$imageCategories->count()>0 ? ' menu-item-has-children ' : ' '}}">
                                    <a href="{{route('frontend.image.gallery')}}">Photos Gallery</a>
                                        <ul class="sub-menu">
                                            @foreach($imageCategories as $category)
                                                @if($category->images_count>0)
                                                    <li>
                                                        <a href="{{route('frontend.image.gallery1',[$category->slug])}}">{{$category->title}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                </li>
                                @endif

                                @php $videoCategories= \App\VideoGalleryCategory::where(['status' =>'publish','lang'=>'en'])->withCount('videos')->orderBy('id','desc')->get(); @endphp
                                <li class=" {{$videoCategories->count()>0 ? 'menu-item-has-children ' : ' '}}  ">
{{--                                    <a href="{{route('frontend.gallery.video.index')}}">Video Gallery</a>--}}
                                    <a href="javascript:void(0);">Video Gallery</a>
                                    @if($videoCategories->count()>0)
                                        <ul class="sub-menu">
                                            @foreach($videoCategories as $category)
                                                @if($category->videos_count>0)
                                                    <li>
                                                        <a href="{{route('frontend.gallery.video.index',[$category->slug])}}">{{$category->name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach()
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('frontend.contact')}}">Contact</a>
                        </li>
                    </ul>

                    <ul class="list-unstyled login-bar mb-0">
                        @if(auth()->check())
                            @php
                                $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                            @endphp
                            <li>
                                <a href="{{$route}}">{{__('Dashboard')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}"
                                   onclick="event.preventDefault();
                                  document.getElementById('userlogout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{route('user.login')}}">{{__('Member Login')}}</a>
                                {{--                                            <span>/</span>--}}
                                {{--                                            <a href="{{route('user.register')}}">{{__('Register')}}</a>--}}
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="order-2 order-lg-2 nav-right-content">
                    <div class="icon-part">
                        <ul>
                            {{--                            @if(!empty(get_static_option('navbar_button')))--}}
                            {{--                                <li>--}}
                            {{--                                    @php--}}
                            {{--                                        $custom_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote');--}}
                            {{--                                    @endphp--}}
                            {{--                                    <div class="btn-wrapper">--}}
                            {{--                                        <a href="{{$custom_url}}"--}}
                            {{--                                           @if(!empty(get_static_option('navbar_button_custom_url_status'))) target="_blank"--}}
                            {{--                                           @endif class="boxed-btn reverse-color">{{get_static_option('navbar_'.$user_select_lang_slug.'_button_text')}}</a>--}}
                            {{--                                    </div>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}

                            <li id="search">
                                <a href="javascript:void(0);">
                                    <i class="flaticon-search-1"></i>
                                </a>
                            </li>
                            @if(!empty(get_static_option('product_module_status')))
                                <li class="cart">
                                    <a href="{{route('frontend.products.cart')}}">
                                        <i class="flaticon-shopping-cart"></i>
                                        <span class="pcount">{{cart_total_items()}}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
