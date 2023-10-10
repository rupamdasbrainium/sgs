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
                        <li class="breadcrumb-item"><a href="#">{{ __('admin.Home') }}</a></li>
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
                        <form id="user_add_form" method="post" action="{{ route('admin.usereditpost', $data['id']) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-4">
                                    <label for="name">{{ __('admin.Name') }}*</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('admin.Enter_Name') }}" required value="{{ $data['data']->name }}">
                                    @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('admin.Email') }}*</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('admin.Enter_Email') }}" required value="{{ $data['data']->email }}">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('admin.Status') }}*</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1" {{ $data['data']->status == 1 ? 'selected' : '' }}>{{ __('admin.Active') }}</option>
                                        <option value="0" {{ $data['data']->status == 0 ? 'selected' : '' }}>{{ __('admin.Inactive') }}</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('admin.Submit') }}</button>
                                <a href="{{ route('admin.userlist', $data['data']->user_type) }}" class="ml-3">{{ __('admin.Cancel') }}</a>
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
@endpush
</x-app-layout>