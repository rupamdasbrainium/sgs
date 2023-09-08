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
                        <form id="user_add_form" method="post" action="{{ route('admin.accountpasswordpost') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password">
                                    @if ($errors->has('old_password'))
                                    <div class="text-danger">{{ $errors->first('old_password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password">
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Confirm Password">
                                    @if ($errors->has('cpassword'))
                                    <div class="text-danger">{{ $errors->first('cpassword') }}</div>
                                    @endif
                                </div>
                                
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