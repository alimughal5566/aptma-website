@extends('backend.admin-master')
@section('site-title')
    {{__('Circulars')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
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

            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Books')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="" selected disabled>{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_gallery_images as $key => $image)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40">
                            @php $b=0; $key=0 ;@endphp
{{--                            @foreach($all_gallery_images as $key => $galleries)--}}
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default" id="all_blog_table">
                                            <thead>
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Category')}}</th>
                                            <th>{{__('Image')}}</th>

                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Is featured')}}</th>
                                            <th>{{__('Last updated')}}</th>
                                            <th>{{__('Action')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($all_gallery_images as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td><a class="text-white" href="{{route('frontend.circular.single',$data->id)}}">{{$data->id}}</a></td>

                                                    <td>{{$data->title}}</td>
                                                    <td>{{@$data->category->name}}</td>
                                                    <td> @php
                                                            $testimonial_img = get_attachment_image_by_id($data->thumbnail,'thumbnail',true);
                                                        @endphp
                                                        @if (!empty($testimonial_img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <a href="{{$data->description}}" target="_blank" class="float-right text-right" >
                                                                        <img class="avatar user-thumb" src="{{$testimonial_img['img_url']}}" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                    </td>

                                                    <td>{{($data->status=='1')?'Active':'Not active'}}</td>
                                                    <td>{{($data->is_featured=='1')?'Yes':'No'}}</td>
                                                    <td>{{@$data->updated_at->format('d-M-Y')}}</td>

                                                    <td>
                                                        <a tabindex="0" class="btn btn-danger btn-xs mb-3 mr-1"
                                                           role="button"
                                                           data-toggle="popover"
                                                           data-trigger="focus"
                                                           data-html="true"
                                                           title=""
                                                           data-content="
                                                           <h6>{{__('Are you sure to delete this Circular ?')}}</h6>
                                                           <form method='post' action='{{route('admin.circular.delete',$data->id)}}'>
                                                           <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                                           <br>
                                                            <input type='submit' class='btn btn-danger btn-sm' value='{{__('Yes,Please')}}'>
                                                            </form>
                                                            ">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#testimonial_item_edit_modal"
                                                           class="btn btn-lg btn-primary btn-xs mb-3 mr-1 testimonial_edit_btn"
                                                           data-id="{{$data->id}}"
                                                           data-title="{{$data->title}}"
                                                           data-imageid="{{$data->thumbnail}}"
                                                           data-description="{{$data->description}}"
                                                           data-image="{{$testimonial_img['img_url']}}"
                                                           data-status="{{$data->status}}"
                                                           data-is_featured="{{$data->is_featured}}"
                                                           data-publish_date="{{$data->publish_date}}"
                                                           data-category="{{$data->cat_id}}"
                                                           data-url="{{$data->url}}">
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
{{--                            @endforeach--}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Circular')}}</h4>
                        <form action="{{route('admin.circular.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" name="title" id="title" class="form-control" required placeholder="Title" value="{{old('title')}}">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" required>
                                    @foreach($all_categories as $category)
                                        <option {{(old('category')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>


{{--                            <div class="form-group">--}}
{{--                                <label>{{__('Url')}}</label>--}}
{{--                                <input type="url" name="url"  class="form-control" required placeholder="Youtube Url" value="{{old('description')}}">--}}

{{--                            </div>--}}
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <input type="hidden" name="description">
                                <div class="summernote"></div>
                            </div>

                            <div class="form-group">
                                <label for="date">Publish Date</label>
                                <input type="date" class="form-control datepicker"  name="publish_date" placeholder="Date"  value="{{old('publish_date')}}">
                            </div>
                            <div class="form-group">
                                <label class="mb-0" for="image">{{__('Thumbnail')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="thumbnail" value="old({{old('thumbnail')}}")>
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Placeholder Image')}}
                                    </button>
                                </div>
                                <small>{{__('1000x1000 px image recommended')}}</small>
                            </div>
                            <div class="form-group ">
                                <label for="date">File</label>
                                <input type="file" class="form-control"  name="pdf_file" placeholder="Pdf File" accept="application/pdf">
                                <small>{{__('Allowed extensions:pdf')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="category">Status</label>
                                <select name="status" class="form-control" >
                                    <option {{(old('status')=='1')?'selected':''}} value="1">Active</option>
                                    <option {{(old('status')=='0')?'selected':''}}  value="0">De active</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category">Is featured</label>
                                <select name="is_featured" class="form-control" >
                                    <option value="1" {{(old('is_featured')=='1')?'selected':''}}>Yes</option>
                                    <option value="0" {{(old('is_featured')=='0')?'selected':''}}>No</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.circular.update')}}" id="testimonial_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="gallery_id" value="" >

                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" required>
                                @foreach($all_categories as $category)
                                    <option {{(old('category')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach

                            </select>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{__('Url')}}</label>--}}
{{--                            <input type="url" name="url" class="form-control" required >--}}

{{--                        </div>--}}
                        <div class="form-group">
                            <label>{{__('Description')}}</label>
                            <input type="hidden" name="description">
                            <div class="summernote"></div>
                        </div>
                        <div class="form-group">
                            <label for="date">Publish Date</label>
                            <input type="date" class="form-control datepicker"  name="publish_date" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label for="featured">{{__('Featured')}}</label>
                            <select name="is_featured" class="form-control">
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="edit_image" value="">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                    {{__('Upload Image')}}
                                </button>
                            </div>
                            <small>{{__('1000x1000 px image recommended')}}</small>
                        </div>
                        <div class="form-group ">
                            <label for="date">File</label>
                            <input type="file" class="form-control" name="pdf_file" placeholder="Pdf File" accept="application/pdf">
                            <small>Allowed extensions:pdf</small>
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
{{--    @include('backend.partials.media-upload.media-file-markup')--}}
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
                if(allIds != '' && bulkOption == 'delete'){

                    $(this).text('{{__('Deleting...')}}');
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        icon: 'warning',
                        title: 'updated successfully',
                    });
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.circular.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
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

            $(document).on('click','.testimonial_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var image = el.data('image');
                var imageid = el.data('imageid');
                var description = el.data('description');
                var status = el.data('status');
                var is_featured = el.data('is_featured');
                var category = el.data('category');
                var url = el.data('url');

                var form = $('#testimonial_edit_modal_form');
                form.find('#gallery_id').val(id);
                form.find('#edit_title').val(el.data('title'));
                form.find('input[name="description"]').val(description);
                form.find('input[name="url"]').val(url);
                form.find('input[name="publish_date"]').val(el.data('publish_date'));

                form.find('select[name="is_featured"] option[value="'+is_featured+'"]').attr('selected',true);
                form.find('select[name="status"] option[value="'+status+'"]').attr('selected',true);
                form.find('select[name="category"] option[value="'+category+'"]').attr('selected',true);

                $('#testimonial_item_edit_modal .note-editable').html(description);

                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
                $('#summernote').summernote({
                    height: 200,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                } );

            });
            $(document).on('change','select[name="lang"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var selectedLang = $(this).val();
                $.ajax({
                    url : "{{route('admin.circular.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success:function (data) {
                        var galCat = $('select[name="cat_id"]');
                        galCat.html('');
                        $.each(data,function (index,value) {
                            galCat.append('<option value="'+value.id+'">'+value.title+'</option>');
                        })
                    }
                });
            });
        });
    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function() {
            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
        $('.summernote').summernote({
            height: 200,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            callbacks: {
                onChange: function(contents, $editable) {
                    $(this).prev('input').val(contents);
                }
            }
        } );



    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
