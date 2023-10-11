@section('title', $data['title'] . ' |')
<x-admin-layout>
@include('admin.header')
<section class="maincontent_wrap inner_pageouter">
    <div class="inner_page_wrap">
        @include('admin.leftpanel')
        <div class="inner_page_des">
            <div class="content_block accountinfo">
                <div class="blocktitle">
                    <h2 class="addpadding">{{ __('admin.Admin_CMS') }}</h2>
                    <div class="fromdes_view ">
                        <div class="fromdes_info">
                            <div class="from_contentblock configuration_info">
                                <form method="post" action="{{route('admin.cmsViewPost', $data['id'])}}">
                                    @csrf
                                    <div class="inp_row">
                                        <div class="form-group">
                                            <label>{{ __('admin.Title') }}<em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                {{-- <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required value="{{ $data['data']->title }}"> --}}
                                                <input type="text" class="form-control" name="title" id="title" placeholder="{{ __('admin.Enter_Title') }}" required value="{{ $data['data']['title'] }}">
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>{{ __('admin.Body') }}<em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <textarea class="form-control" id="body" name="body" required>{{ $data['data']['body'] }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label>{{ __('admin.Body') }} [{{ __('admin.English') }}]<em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <textarea class="form-control" id="enbody" name="body_english" >{{ $data['data']['english'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('admin.Body') }} [{{ __('admin.French') }}]<em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <textarea class="form-control" id="frbody" name="body_french" >{{ $data['data']['french'] }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>{{ __('admin.Slug') }} <em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <input type="text" class="form-control" name="slug" id="slug" placeholder="{{ __('admin.Enter_slug') }}" required value="{{ $data['data']['slug'] }}" readonly>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label>Status <em class="req_text">*</em> </label>
                                            <div class="inp_cont_view noicon_opt">
                                                <select name="status" id="status" class="form-control" required readonly> 
                                                    <option value="1" {{ $data['data']['status'] == 1 ? 'selected' : '' }}>{{ __('admin.Active') }}</option>
                                                    <option value="0" {{ $data['data']['status'] == 0 ? 'selected' : '' }}>{{ __('admin.Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        
                                    </div>
                                    
                                    <div class="frombtn_wrap singcol_btn">
                                        <div class="def_btnopt2 frombtn frombtn2">
                                            <button type="submit" class="btn2" style="background-color: {{$button->value}}">Save</button>
                                        </div>
                                    </div>
                                </form>
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
//   $('#body').summernote({
//     height: 400,
//     callbacks: {
//         onImageUpload: function(files, editor, welEditable) {
//             sendFile(files, editor, welEditable, 'body_en');
//         } 
//     }
//   });
  $('#enbody').summernote({
    height: 400,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files, editor, welEditable, 'body_en');
        } 
    }
  });
  $('#frbody').summernote({
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