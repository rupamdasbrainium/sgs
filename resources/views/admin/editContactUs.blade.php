<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> {{ __('admin.Generate_Report') }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="container col-lg-9">
                <div class="pull-left text-center">
                    <h2>{{ __('admin.Edit_Contact_Us') }}</h2>
                </div>


                <div class="card-body">
                    <form action="{{ route('admin.update-contact-us',['id' => $data->id]) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('admin.Name') }}</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Name" value="{{$data->name}}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Email') }}</label>
                            <input class="form-control" type="email" name="email" placeholder="Enter Email" value="{{$data->email}}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Comment') }}</label>
                            <textarea class="form-control" type="text" name="comment" id="comment" placeholder="Enter comment" required
                                cols="30" rows="10">{{ $data->comment }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn-btn-sm btn-primary">{{ __('admin.Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>


    </div>
    <!--/.container-fluid -->

    </div>
    <!--End of Main Content-->
</x-app-layout>
