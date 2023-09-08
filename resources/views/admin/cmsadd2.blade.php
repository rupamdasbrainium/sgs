<x-admin-layout>
@section('title', $data['title'] . ' |')
<!-- Begin Page Content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $data['title'] }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['form_caption'] }}</h3>
                        </div>
                        @if(Session::has('message'))
                        <p class="alert alert-{{ Session::get('message_type') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form id="user_add_form" method="post" action="{{ route('admin.cmsaddpost', $data['id']) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required value="{{ $data['data']->title }}">
                                    @if ($errors->has('title'))
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea class="form-control" id="body" name="body" required>{{ $data['data']->body }}</textarea>
                                    @if ($errors->has('body'))
                                    <div class="text-danger">{{ $errors->first('body') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="slug">Slug*</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug" required value="{{ $data['data']->slug }}">
                                    @if ($errors->has('slug'))
                                    <div class="text-danger">{{ $errors->first('slug') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Status*</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1" {{ $data['data']->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $data['data']->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.cms') }}" class="ml-3">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- End of Main Content -->
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
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

function sendFile(files, editor, welEditable, el_id) {
    data = new FormData();
    // data.append("files", files);
    for (var i = 0; i < files.length; i++) {
      data.append("files" + i, files[i]);
    }
    upload_url = '';
    $.ajax({
        data: data,
        type: "POST",
        dataType: 'json',
        url: upload_url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          for (var i = 0; i < response.data.length; i++) {
            var image = $('<img>').attr('src', response.data[i]);
            $('#' + el_id).summernote("insertNode", image[0]);
          }
        }
    });
}
</script>
@endpush
</x-app-layout>