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
                                            <li>
                                                <a href="{{route('frontend.members')}}">Member List</a>
                                            </li>
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

                                <li>
                                    <a href="{{route('frontend.dailyEconomicsUpdate')}}">Daily Economic Updates</a>
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

                        <li class=" menu-item-has-children ">
                            <a href="{{route('frontend.circular.index')}}">Circulars</a>
                            <ul class="sub-menu">
                                @php $categories=\App\CircularCategory::where(['status' =>'publish','lang'=>'en'])->orderBy('id','desc')->get(); @endphp
                                @if($categories->count()>0)

                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{route('frontend.circular.index',[$category->slug])}}">{{$category->name}}</a>
                                        </li>
                                    @endforeach()

                                @endif
                            </ul>
                        </li>

                        <li class=" menu-item-has-children ">
                            <a href="javascript:void(0);">Statistics</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{route('frontend.daily.stats')}}">Daily Exchange & Cotton Rates</a>
                                </li>

                                <li class=" menu-item-has-children ">
                                    <a href="#">Textile Industry</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">Growth of Cotton Textile Industry in Pakistan</a>
                                        </li>
                                        <li>
                                            <a href="#">Growth of Textile Industry in Pakistan: Province - Wise</a>
                                        </li>
                                        <li>
                                            <a href="#">Consumption of Raw Material</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" menu-item-has-children ">
                                    <a href="#">Raw Material</a>
                                    <ul class="sub-menu">
                                        <li class=" menu-item-has-children ">
                                            <a href="#">Cotton</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Supply &amp; Distribution of Cotton</a>
                                                </li>
                                                <li>
                                                    <a href="#">Upland Area, Production &amp; Yield of Cotton</a>
                                                </li>
                                                <li>
                                                    <a href="#">Staple - wise Production of Cotton</a>
                                                </li>
                                                <li>
                                                    <a href="#">Arrival of Cotton: (District - wise)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Arrival of Seed Cotton (Month-wise)</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('frontend.statistics.get.table',['type'=>'month_wise_district_wise'])}}">Arrival
                                                        of Cotton: (Month-wise & District wise)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Seed Cotton Market Price</a>
                                                </li>
                                                <li>
                                                    <a href="#">Raw Cotton (Fine Machine Gin) Price at Karachi (Annual
                                                        Average)</a>
                                                </li>
                                                <li>
                                                    <a href="#">KCA Spot Rate of Sawgin Cotton Month-Wise Average</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class=" menu-item-has-children ">
                                            <a href="#">Man-Made Fibre</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Local Market Price of Man-Made Staple Fibre at Karachi
                                                        (With Sales Tax)</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" menu-item-has-children ">
                                    <a href="#">Textile Products</a>
                                    <ul class="sub-menu">
                                        <li class=" menu-item-has-children ">
                                            <a href="#">Yarn</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Production of Yarn: Province-wise</a>
                                                </li>
                                                <li>
                                                    <a href="#">Production of Yarn: Province-wise</a>
                                                </li>
                                                <li>
                                                    <a href="#">Production of Yarn: Category-wise</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('frontend.statistics.get.table',['type'=>'production_export'])}}">Production,
                                                        Export &amp; Domestic Requirement of Yarn</a>
                                                </li>
                                                <li>
                                                    <a href="#">Production of Yarn: Category-wise</a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Cloth</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Production of Cloth: Province-wise (Mill Sector)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Production of Cloth: Category-wise & Variety-wise</a>
                                                </li>
                                                <li>
                                                    <a href="#">Production, Export and Domestic Requirement of Cloth</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" menu-item-has-children ">
                                    <a href="#">International Trade</a>
                                    <ul class="sub-menu">
                                        <li class=" menu-item-has-children ">
                                            <a href="#">Export</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Pakistan Principal Exports (July - June)</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('frontend.statistics.get.table',['type'=>'export_of_raw_cotton'])}}">Export
                                                        Of Raw Cotton</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country - wise Export of Raw Cotton</a>
                                                </li>
                                                <li>
                                                    <a href="#">Export of Cotton Yarn</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Cotton Yarn</a>
                                                </li>
                                                <li>
                                                    <a href="#">Market Share Position of Cotton Yarn</a>
                                                </li>
                                                <li>
                                                    <a href="#">Export of Cotton Cloth</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Cotton Cloth</a>
                                                </li>
                                                <li>
                                                    <a href="#">Market Share Position of Cotton Cloth</a>
                                                </li>
                                                <li>
                                                    <a href="#">Export of Cotton &amp; Cotton Manufactures</a>
                                                </li>
                                                <li>
                                                    <a href="#">Export of Textile (Qty, Value &amp; Unit Value)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Ready-Made Garments (Excluding
                                                        Hosiery)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Knitwear</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Other Made-ups (Exluding Towels
                                                        &amp; Bedwear)</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Bedwear</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Towels</a>
                                                </li>
                                                <li>
                                                    <a href="#">Country-wise Export of Synthetic</a>
                                                </li>
                                                <li>
                                                    <a href="#">Pakistan Textile Principal Buyers</a>
                                                </li>
                                                <li>
                                                    <a href="#">Pakistan's Export to EU</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class=" menu-item-has-children ">
                                            <a href="#">Import</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">Cotton Imports</a>
                                                </li>
                                                <li>
                                                    <a href="#">Import of Man-Made Fibre</a>
                                                </li>
                                                <li>
                                                    <a href="#">Import of Textile Machinery</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" menu-item-has-children ">
                                    <a href="#">Global Statistics</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">Pakistan Share of Textiles in World Trade</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Raw Material Consumption</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Production of Cotton</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Consumption of Cotton</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Export of Cotton</a>
                                        </li>
                                        <li>
                                            <a href="{{route('frontend.statistics.get.table',['type'=>'global_impact'])}}">Global
                                                Import of Cotton</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Production of Yarn</a>
                                        </li>
                                        <li>
                                            <a href="#">Global Production of Cloth</a>
                                        </li>
                                        <li>
                                            <a href="#">World Supply, Usage & Trade of Cotton</a>
                                        </li>
                                        <li>
                                            <a href="#">World Consumption of Cotton, Fibre & Wool</a>
                                        </li>
                                        <li>
                                            <a href="#">World General Economic Data</a>
                                        </li>
                                        <li>
                                            <a href="#">World General Economic Data</a>
                                        </li>
                                        <li>
                                            <a href="#">World Basic Structure Data (World Installed Capacity)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Basic Structure Data (Labour)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Activity Level (Fibre Consumption)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Activity Level (Spun- Yarn Production)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Activity Level (Fibric Production)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Activity Level (Capacity Utilization)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Textile &amp; Apparel Trade (Imports)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Textile &amp; Apparel Trade (Imports in value Terms)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Textile &amp; Apparel Trade (Imports in value Terms)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Textile &amp; Apparel Trade (Exports in value Terms)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Textile &amp; Apparel Trade (Exports value of all Textile
                                                &amp; Apparel)</a>
                                        </li>
                                        <li>
                                            <a href="#">World Cotton and Non Cotton Textile Fiber Consumption</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class=" menu-item-has-children">
                            <a href="javascript:void(0);">Members Directory</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0);">Members List</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Become a member</a>
                                </li>
                            </ul>
                        </li>

                        <li class=" menu-item-has-children ">
                            <a href="javascript:void(0);">News & Events</a>
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
                                    <a href="javascript:void(0);">Videos Gallery</a>
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
                                <li>
                                    <a href="{{route('frontend.advertisement.index')}}">Advertisements</a>
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
