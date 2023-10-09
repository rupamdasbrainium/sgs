<x-admin-layout>
@section('title', $data['title'] . ' |')
<!-- Begin Page Content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 title-bar">
                    <h1>{{ $data['title'] }}</h1>
                    <a href="{{ route('admin.cmsadd') }}">{{ __('cms.Add_Content') }}</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('cms.Home') }}</a></li>
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
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data'] as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->slug }}</td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                        <td>{{ ($value->status) ? 'Active' : 'Inactive' }}</td>
                                        <td style="width:200px;">
                                            <a href="{{ route('admin.cmsadd2', $value->id) }}" class="btn btn-primary fas fa-edit">Edit</a>
                                            <?php if (!$value->readable) { ?>
                                            <a href="{{ route('admin.cmsdelete', $value->id) }}" onclick="return delChk()" class="btn btn-danger btn-del fa fa-trash">Delete</a>
                                            <?php } ?>
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
<!-- End of Main Content -->
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#dtable").DataTable().buttons().container().appendTo('#dtable_wrapper .col-md-6:eq(0)');
  });

  function delChk () {
    if (!confirm('Are you sure you want to delete this content?')) {
      return false;
    }
  }
</script>
@endpush
</x-app-layout>