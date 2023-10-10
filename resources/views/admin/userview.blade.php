<x-admin-layout>
@section('title', $data['title'] . ' |')
<!-- Begin Page Content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 title-bar">
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

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if (!empty($data['data']->image))
                        <a href="{{ asset($data['data']->image) }}" data-toggle="lightbox" data-title="ID Card">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset($data['data']->image) }}" alt="{{ __('admin.User_profile_picture') }}">
                        </a>
                        @else
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/user.jpg') }}" alt="{{ __('admin.User_profile_picture') }}">
                        @endif
                    </div>
                    <h3 class="profile-username text-center">{{ $data['data']->name }}</h3>
                    <p class="text-muted text-center">{{ getUserTypeText($data['data']->user_type) }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ __('admin.Details') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> {{ __('admin.Email') }}</strong>
                <p class="text-muted">
                  {{ $data['data']->email }}
                </p>
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i> {{ __('admin.Phone') }}</strong>
                <p class="text-muted">{{ $data['data']->phone }}</p>
                
                @if (!empty($data['data']->address))
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i> {{ __('admin.Address') }}</strong>
                <p class="text-muted">{{ $data['data']->address }}</p>
                @endif
                @if (!empty($data['data']->city))
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i> {{ __('admin.City') }}</strong>
                <p class="text-muted">{{ $data['data']->city }}</p>
                @endif
                @if (!empty($data['data']->country))
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i> {{ __('admin.Country') }}</strong>
                <p class="text-muted">{{ $data['data']->country }}</p>
                @endif
                @if (!empty($data['data']->pincode))
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i> {{ __('admin.Post_Code') }}</strong>
                <p class="text-muted">{{ $data['data']->pincode }}</p>
                @endif
                @if (!empty($data['data']->dob))
                <hr>
                <strong><i class="fas fa-phone-alt mr-1"></i>{{ __('admin.DOB') }}</strong>
                <p class="text-muted">{{ $data['data']->dob }}</p>
                @endif

                @if (!empty($data['data']->image))
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> {{ __('admin.ID') }}</strong>
                <p class="text-muted">
                    <div class="filtr-item col-sm-2" data-category="id_card" data-sort="ID Card">
                        <a href="{{ asset($data['data']->id_card) }}" data-toggle="lightbox" data-title="ID Card">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset($data['data']->id_card) }}" alt="{{ __('admin.User_profile_picture') }}">
                        </a>
                    </div>
                </p>
                @endif
                <div class="text-center"><a href="{{ route('admin.userlist', $data['data']->user_type) }}">{{ __('admin.Back') }}</a></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<!-- End of Main Content -->
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  });

  function delChk () {
    if (!confirm('Are you sure you want to delete this content?')) {
      return false;
    }
  }
</script>
@endpush
</x-app-layout>