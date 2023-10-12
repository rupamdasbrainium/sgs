@section('title', $data['title'] . ' |')
<x-admin-layout>
@include('admin.header')
<section class="maincontent_wrap inner_pageouter">
    <div class="inner_page_wrap">
        @include('admin.leftpanel')
        <div class="inner_page_des">
            <div class="content_block accountinfo">
                <div class="blocktitle">
                    <h2 class="addpadding">{{ __('admin.Content_Management') }}</h2>
                    <div class="frombtn_wrap singcol_btn">
                        {{-- <div class="def_btnopt2 frombtn frombtn2">
                            <a href="{{ route('admin.cmsView') }}"><button type="button" style="background-color: {{$button->value}}" class="btn2">{{ __('admin.Add_Content') }}</button></a>
                        </div> --}}
                    </div>
                    <div class="fromdes_view ">
                        <div class="fromdes_info">
                            <div class="from_contentblock configuration_info">
                                    <div class="inp_row">
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="#">{{ __('admin.Home') }}</a></li>
                                                <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                                            </ol>
                                        </div>

                                            <section class="content">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <!-- <div class="card-header">
                                                                    <h3 class="card-title">DataTable with default features</h3>
                                                                </div> -->
                                                                <?php if (session("message")) { ?>
                                                                <div class="alert alert-<?php echo session("message_type"); ?> alert-dismissible fade show" role="alert">
                                                                    <?php echo session("message"); ?>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?php } ?>
                                                                <div class="card-body">
                                                                    <table id="dtable" class="table table-bordered table-striped">
                                                                        <thead >
                                                                            <tr>
                                                                                <th style="background-color: {{$theme->value}}">#</th>
                                                                                <th style="background-color: {{$theme->value}}">{{ __('admin.Title_en') }}</th>
                                                                                <th style="background-color: {{$theme->value}}">{{ __('admin.Title_fr') }}</th>
                                                                                {{-- <th style="background-color: {{$theme->value}}">{{ __('admin.Slug') }}</th> --}}
                                                                                <th style="background-color: {{$theme->value}}">{{ __('admin.Created_Date') }}</th>
                                                                                {{-- <th style="background-color: {{$theme->value}}">{{ __('admin.Status') }}</th> --}}
                                                                                <th style="background-color: {{$theme->value}}">{{ __('admin.Action') }}</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($data['data'] as $key => $value)
                                                                            <tr>
                                                                                <td>{{ $key + 1 }}</td>
                                                                                <td>{{ $value->title_en }}</td>
                                                                                <td>{{ $value->title_fr }}</td>
                                                                                {{-- <td>{{ $value->slug }}</td> --}}
                                                                                <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                                                                {{-- <td>{{ ($value->status) ?  __('admin.Active')  : __('admin.Inactive') }}</td> --}}
                                                                                <td style="width:200px;">
                                                                                    <a href="{{ route('admin.editcms', $value->id) }}" class="btn btn-primary fas fa-edit">{{ __('admin.Edit') }}</a>
                                                                                    {{-- <?php if (!$value->readable) { ?>
                                                                                    <a href="{{ route('admin.cmsdelete', $value->id) }}" onclick="return delChk()" class="btn btn-danger btn-del fa fa-trash">{{ __('admin.Delete') }}</a>
                                                                                    <?php } ?> --}}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            
                                    </div>
                                    
                                    {{-- <div class="frombtn_wrap singcol_btn">
                                        <div class="def_btnopt2 frombtn frombtn2">
                                            <button type="submit" class="btn2">Save</button>
                                        </div>
                                    </div> --}}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.footer')
@push('css')
<link rel="stylesheet" href="{{ asset('public/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#body').summernote({
    height: 400,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files, editor, welEditable, 'body_en');
        } 
    }
  });
});
</script>
@endpush
</x-admin-layout>