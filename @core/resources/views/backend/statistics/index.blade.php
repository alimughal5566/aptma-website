@extends('backend.admin-master')
@section('site-title')
    {{__('Statistics')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
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
            <div class="col-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Excel Uploads')}}</h4>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($excel_sheets[0])
                                @foreach($excel_sheets as $key=>$sheet)
                                    <tr>
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$sheet->sheet_data[1][0]}}</td>
                                        <td>{{$sheet->created_at}}</td>
                                        <td><a href="{{route('admin.statistics.remove.excel.sheet',[$sheet->id])}}">Remove</a></td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add Stats')}}</h4>
                        <form action="{{route('admin.statistics.import')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" required>
                                    @foreach($all_categories as $category)
                                        <option {{(old('category')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select name="sub_category" class="form-control">
                                    <option value="">Choose Sub Category</option>
                                    @foreach($all_sub_categories as $category)
                                        <option {{(old('sub_category')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="date">File</label>
                                <input type="file" class="form-control" name="file" placeholder="Attach File"
                                       accept="application/xlsx">
                                <small>{{__('Allowed extensions:xls,xlsx')}}</small>
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
                    <h5 class="modal-title">{{__('Edit Publish Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.exchnage.update')}}" id="testimonial_edit_modal_form" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="gallery_id" value="">

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
                        <div class="form-group">
                            <label for="sub_category">Category</label>
                            <select name="sub_category" class="form-control" required>
                                @foreach($all_sub_categories as $category)
                                    <option {{(old('sub_category')==$category->id)?'selected':''}} value="{{$category->title}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{__('Description')}}</label>
                            <input type="hidden" name="description" required>
                            <div id="summernote" class="summernote" required></div>
                        </div>
                        <div class="form-group">
                            <label for="date">Publish Date</label>
                            <input type="date" class="form-control datepicker" name="publish_date" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label for="featured">{{__('Featured')}}</label>
                            <select name="is_featured" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="edit_image" value="{{old('edit_image')}}">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal"
                                        data-target="#media_upload_modal">
                                    {{__('Upload Image')}}
                                </button>
                            </div>
                            <small>{{__('1000x1000 px image recommended')}}</small>
                        </div>
                        <div class="form-group ">
                            <label for="date">File</label>
                            <input type="file" class="form-control" name="pdf_file" placeholder="Pdf File"
                                   accept="application/pdf">
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

    <script>
        $(document).ready(function () {

            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox = $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds != '' && bulkOption == 'delete') {
                    $(this).text('{{__('Deleting...')}}');
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
                        'type': "POST",
                        'url': "{{route('admin.exchnage.bulk.action')}}",
                        'data': {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success: function (data) {

                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change', function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if (value == true) {
                    allChek.prop('checked', true);
                } else {
                    allChek.prop('checked', false);
                }
            });

            $(document).on('click', '.testimonial_edit_btn', function () {
                var el = $(this);
                var id = el.data('id');
                var image = el.data('image');
                var imageid = el.data('imageid');
                var description = el.data('description');
                var status = el.data('status');
                var is_featured = el.data('is_featured');
                var category = el.data('category');

                var form = $('#testimonial_edit_modal_form');
                form.find('#gallery_id').val(id);
                form.find('#edit_title').val(el.data('title'));
                form.find('input[name="description"]').val(description);
                form.find('input[name="publish_date"]').val(el.data('publish_date'));

                form.find('select[name="is_featured"] option[value="' + is_featured + '"]').attr('selected', true);
                form.find('select[name="status"] option[value="' + status + '"]').attr('selected', true);
                form.find('select[name="category"] option[value="' + category + '"]').attr('selected', true);

                $('#testimonial_item_edit_modal .note-editable').html(description);

                if (imageid != '') {
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' + image + '" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
                $('#summernote').summernote({
                    height: 200,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });

            });
            $(document).on('change', 'select[name="lang"]', function (e) {
                e.preventDefault();
                var el = $(this);
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.gallery.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        lang: selectedLang
                    },
                    success: function (data) {
                        var galCat = $('select[name="cat_id"]');
                        galCat.html('');
                        $.each(data, function (index, value) {
                            galCat.append('<option value="' + value.id + '">' + value.title + '</option>');
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
        $(document).ready(function () {
            $('.table-wrap > table').DataTable({
                "order": [[1, "desc"]],
                'columnDefs': [{
                    'targets': 'no-sort',
                    'orderable': false
                }]
            });
        });
        $('.summernote').summernote({
            height: 200,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            callbacks: {
                onChange: function (contents, $editable) {
                    $(this).prev('input').val(contents);
                }
            }
        });


    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
