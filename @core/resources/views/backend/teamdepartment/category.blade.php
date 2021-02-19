@extends('backend.admin-master')
@section('site-title')
    {{__('Team members Department')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend.partials.message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Team Departments')}}</h4>
{{--                        <div class="bulk-delete-wrapper">--}}
{{--                            <div class="select-box-wrap">--}}
{{--                                <select name="bulk_option" id="bulk_option">--}}
{{--                                    <option value="" selected disabled>{{{__('Bulk Action')}}}</option>--}}
{{--                                    <option value="draft">{{{__('Draft')}}}</option>--}}
{{--                                    <option value="publish">{{{__('publish')}}}</option>--}}
{{--                                    <option value="delete">{{{__('Delete')}}}</option>--}}
{{--                                </select>--}}
{{--                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_category as $key => $slider)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_category as $key => $category)
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default">
                                            <thead>
{{--                                            <th class="no-sort">--}}
{{--                                                <div class="mark-all-checkbox">--}}
{{--                                                    <input type="checkbox" class="all-checkbox">--}}
{{--                                                </div>--}}
{{--                                            </th>--}}
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Image')}}</th>
                                            <th>{{__('Order')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Action')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($category as $data)
                                                <tr>
{{--                                                    <td>--}}
{{--                                                        <div class="bulk-checkbox-wrapper">--}}
{{--                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td> @php
                                                            $testimonial_img = get_attachment_image_by_id($data->img_id,'thumbnail',true);
                                                        @endphp
                                                        @if (!empty($testimonial_img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <img class="avatar user-thumb" src="{{$testimonial_img['img_url']}}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                    </td>
                                                    <td>{{$data->order_no}}</td>
                                                    <td>
                                                        @if('publish' == $data->status)
                                                            <span class="btn btn-success btn-sm">{{ucfirst($data->status)}}</span>
                                                        @else
                                                            <span class="btn btn-warning btn-sm">{{ucfirst($data->status)}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
{{--                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"--}}
{{--                                                           role="button"--}}
{{--                                                           data-toggle="popover"--}}
{{--                                                           data-trigger="focus"--}}
{{--                                                           data-html="true"--}}
{{--                                                           title=""--}}
{{--                                                           data-content="--}}
{{--                                                           <h6>{{__('Are you sure to delete this category?')}}</h6>--}}
{{--                                                           <form method='post' action='{{route('admin.team.category.delete',$data->id)}}'>--}}
{{--                                                           <input type='hidden' name='_token' value='{{csrf_token()}}'>--}}
{{--                                                           <br>--}}
{{--                                                            <input type='submit' class='btn btn-danger btn-sm' value='{{__('Yes,Please')}}'>--}}
{{--                                                            </form>--}}
{{--                                                            ">--}}
{{--                                                            <i class="ti-trash"></i>--}}
{{--                                                        </a>--}}
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#image_category_item_edit_modal"
                                                           class="btn btn-lg btn-primary btn-sm mb-3 mr-1 category_edit_btn"
                                                           data-id="{{$data->id}}"
                                                           data-name="{{$data->name}}"
                                                           data-lang="{{$data->lang}}"
                                                           data-status="{{$data->status}}"
                                                           data-imgid="{{$data->img_id}}"
                                                           data-order="{{$data->order_no}}"
                                                        >
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @php $b++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New department')}}</h4>
                        <form action="{{route('admin.department.category.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="lang">{{__('Languages')}}</label>
                                <select name="lang" class="form-control">
                                    @foreach($all_languages as $lang)
                                    <option value="{{$lang->slug}}" @if($lang->slug == get_default_language()) selected @endif>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lang">{{__('Placement order')}}</label>
                                <select name="order_no" class="form-control">
                                    @for($j=10;$j>=1; $j--)
                                    <option value="{{$j}}"  {{(old('order_no')==$j)?'selected':''}} >{{$j}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" name="title" class="form-control" placeholder="Name"  required value="{{old('title')}}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                        Department Image
                                    </button>
                                </div>
                                <small>1000x1000px image recommended</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image_category_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Department')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.department.category.update')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="lang">{{__('Languages')}}</label>
                            <select name="lang" class="form-control">
                                @foreach($all_languages as $lang)
                                    <option value="{{$lang->slug}}" >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order">{{__('Placement Order')}}</label>
                            <select name="order_no" class="form-control" required >
                                @for($j=10;$j>=1; $j--)
                                    <option value="{{$j}}" >{{$j}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" name="title" class="form-control"  required value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__('Draft')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="image">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                    Branch Image
                                </button>
                            </div>
                            <small>1000x1000 px image recommended</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });

                if(allIds != ''){
                    $(this).text('{{__('Please Wait')}}');
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'warning',
                        title: 'Item added successfully',
                    });
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.department.category.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds,
                            type: bulkOption
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.category_edit_btn',function (){
                var el = $(this);
                var id = el.data('id');
                var img_id = el.data('imgid');
                // alert(img_id);
                var title = el.data('name');
                var status = el.data('status');
                var lang = el.data('lang');
                var order = el.data('order');
                var modalContainerId = $('#image_category_item_edit_modal');
                modalContainerId.find('input[name="id"]').val(id);
                modalContainerId.find('input[name="image"]').val(img_id);
                modalContainerId.find('input[name="title"]').val(title);
                modalContainerId.find('select[name="status"] option[value="'+status+'"]').attr('selected',true);
                modalContainerId.find('select[name="lang"] option[value="'+lang+'"]').attr('selected',true);
                modalContainerId.find('select[name="order_no"] option[value="'+order+'"]').attr('selected',true);
            });
        });
    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table-wrap > table').DataTable( {
                "order": [[ 3, "asc" ]],
                'columnDefs' : [{
                    'targets' : "no-sort",
                    'orderable' : false
                }]
            } );
        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
