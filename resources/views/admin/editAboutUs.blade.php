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
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="container col-lg-9">
                <div class="pull-left text-center">
                    <h2>Edit About Us</h2>
                </div>


                <div class="card-body">
                    <form action="{{ route('admin.update-about-us',['id' => $data->id]) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" required placeholder="Enter Title" 
                               value="{{ $data->title }}">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" type="text" name="content" id="content" placeholder="Enter content" required
                                cols="30" rows="10">{{ $data->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn-btn-sm btn-primary">Update</button>
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
