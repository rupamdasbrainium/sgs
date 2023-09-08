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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['form_caption'] }}</h3>
                        </div>
                        @if(Session::has('message'))
                         <p class="alert alert-{{ Session::get('message_type') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form id="user_add_form" method="post" action="{{ route('admin.adminpostaccount') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required value="{{ $data['user']->name }}">
                                    @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required value="{{ $data['user']->email }}">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="{{ $data['user']->phone }}">
                                    @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <!-- <div class="form-group">
                                    <label for="ufile">Profile Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="ufile" id="ufile" class="custom-file-input" accept="image/jpeg,image/jpg,image/png">
                                            <label class="custom-file-label" for="ufile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uploadimage">&nbsp;</label>
                                    <div class="upload-image"><img src="" width="128"></div>
                                </div> -->
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
</x-app-layout>