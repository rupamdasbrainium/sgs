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
                    class="fas fa-download fa-sm text-white-50"></i>{{ __('admin.Generate_Report') }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="container col-lg-9">
                <div class="pull-left text-center">
                    <h2>{{ __('admin.Admin_Profile') }}</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profile-update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <img src=""
                            style="height:100px;width:100x;border-radius: 50%;" id="myImg1">
                        <!--Changing Profile Image-->
                        <input class="form-control" hidden type="file"
                            name="profile_image" placeholder="Profile Image" id="profile_image"
                            onchange="loadImage(event)">
                            <span class="text-danger">
                                @error('profile_image')
                                    {{$message}}
                                @enderror
                            </span>

                    </div>
                    <div class="d-flex justify-content-center">
                        <label for="profile_image" role="button" class="btn btn-sm btn-success">{{ __('admin.Change_Profile_Image') }}</label>
                    </div>

                    <!--Adding Image Preview-->
                    <script type="text/javascript">
                        function loadImage(event) {
                            var image = document.getElementById('myImg1');
                            image.src = URL.createObjectURL(event.target.files[0]);
                            console.log('Image Loaded');

                        }
                    </script>
                    <!--End Image Preview-->
                    <div class="form-group mt-5">
                        <label>{{ __('admin.Name') }}</label>
                        <input class="form-control" type="text" name="name"
                            placeholder="Enter Name" value="">
                            <span class="text-danger">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin.Email') }}</label>
                        <input class="form-control" type="email" name="email"
                            placeholder="Enter Email" value="">
                            <span class="text-danger">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                    <button class="btn btn-sm btn-primary"
                        type="submit">{{ __('admin.Update_Account') }}</button>

                </form>
                </div>
            </div>


        </div>


    </div>
    <!--/.container-fluid -->

    </div>
    <!--End of Main Content-->
</x-app-layout>
