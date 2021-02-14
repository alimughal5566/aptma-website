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
                        <div class="top-bar-inner">
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
                                            <a href="{{route('user.login')}}">{{__('Login')}}</a>
                                            <span>/</span>
                                            <a href="{{route('user.register')}}">{{__('Register')}}</a>
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
                <div class="responsive-mobile-menu">
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
                        <div class="mobile-cart"><a href="{{route('frontend.products.cart')}}"><i
                                        class="flaticon-shopping-cart"></i> <span
                                        class="pcount">{{cart_total_items()}}</span></a></div>
                    @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#bizcoxx_main_menu"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                    <ul class="navbar-nav">
                        <li><a href="{{url('/')}}">{{ __('Home') }}</a></li>

                        <li class=" menu-item-has-children ">
                            <a href="{{route('frontend.about')}}">About Us</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">Patron in Chief message</a>
                                </li>
                                <li>
                                    <a href="#">Chairman Message</a>
                                </li>
                                <li>
                                    <a href="#">Executive Director</a>
                                </li>
                                <li class="menu-item-has-children ">
                                    <a href="#">Members of Executive Committees</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">Executive Commitee</a>
                                        </li>
                                        <li>
                                            <a href="#">Admin and Finance</a>
                                        </li>
                                        <li class="menu-item-has-children ">
                                            <a href="#">Standing Committee</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Cotton & Raw Material</a>
                                                </li>
                                                <li>
                                                    <a href="#">FBR</a>
                                                </li>
                                                <li>
                                                    <a href="#">Re-structure</a>
                                                </li>
                                                <li>
                                                    <a href="#">Energy</a>
                                                </li>
                                                <li>
                                                    <a href="#">Polyester, Fiber and Synthetic fiber</a>
                                                <li>
                                                <li>
                                                    <a href="#">Others</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                @php $teams=\App\TeamCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($teams->count()>0)
                                    {{----}}{{----}}{{--                                    @php dd($teams) @endphp--}}{{----}}{{----}}
                                    <li class="menu-item-has-children ">
                                        <a href="{{route('frontend.team')}}">Team</a>
                                        <ul class="sub-menu">
                                            @foreach($teams as $team)
                                                <li>
                                                    <a href="{{route('frontend.team',[$team->id])}}">{{$team->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class=" menu-item-has-children ">
                            <a href="#">Research & Publications</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">Research Team</a>
                                </li>
                                @php $categories=\App\BlogCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($categories->count()>0)
                                    <li class="menu-item-has-children ">
                                        {{--                                        <a href="{{route('frontend.pages.blog')}}">Publications</a>--}}
                                        <a href="#">Blogs & Articles</a>
                                        <ul class="sub-menu">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{route('frontend.blog',[$category->id])}}">{{$category->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif

                                <li>
                                    <a href="#">Policy Document</a>
                                </li>
                                @php $categories=\App\PublicationCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($categories->count()>0)
                                    <li class="menu-item-has-children ">
                                        <a href="{{route('frontend.publication')}}">Publications</a>
                                        <ul class="sub-menu">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{route('frontend.publication',[$category->id])}}">{{$category->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                                @php $categories=\App\BookCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($categories->count()>0)
                                    {{--                                    @php dd($teams) @endphp--}}
                                    <li class="menu-item-has-children ">
                                        <a href="{{route('frontend.book.index')}}">Books</a>
                                        <ul class="sub-menu">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{route('frontend.book.index',[$category->id])}}">{{$category->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class=" menu-item-has-children ">
                            <a href="{{route('frontend.circular.index')}}">Circulars</a>
                            <ul class="sub-menu">
                                @php $categories=\App\CircularCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($categories->count()>0)

                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{route('frontend.circular.index',[$category->id])}}">{{$category->name}}</a>
                                        </li>
                                    @endforeach()

                                @endif
                            </ul>
                        </li>
                        <li class=" menu-item-has-children ">
                            <a href="#">Statistics</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">Cotton</a>
                                </li>
                                <li>
                                    <a href="#">Production</a>
                                </li>
                                <li>
                                    <a href="#">Exports</a>
                                </li>
                                <li>
                                    <a href="#">Category1</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" menu-item-has-children">
                            <a href="#">Members Directory</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">Members Pages</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" menu-item-has-children ">
                            <a href="#">Events</a>
                            <ul class="sub-menu">
{{--                                <li class="menu-item-has-children ">--}}
{{--                                    <a href="{{route('frontend.image.gallery')}}">Photos Gallery</a>--}}
{{--                                    <ul class="sub-menu">--}}
{{--                                        @php $categories= \App\ImageGalleryCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp--}}
{{--                                        @if($categories->count()>0)--}}
{{--                                            @foreach($categories as $category)--}}
{{--                                                <li>--}}
{{--                                                    <a href="{{route('frontend.image.gallery',[$category->id])}}">{{$category->title}}</a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach()--}}
{{--                                        @endif--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                <li class="menu-item-has-children ">
                                    <a href="{{route('frontend.gallery.video.index')}}">Video Gallery</a>
                                    <ul class="sub-menu">
                                        @php $categories= \App\VideoGalleryCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                        @if($categories->count()>0)
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{route('frontend.gallery.video.index',[$category->id])}}">{{$category->name}}</a>
                                                </li>
                                            @endforeach()
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('frontend.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="nav-right-content">
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
                                <a href="#">
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
    </div>
    </nav>
</div>
</div>
