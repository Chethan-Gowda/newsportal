@extends('admin.layout.adminlayout')
@section('title','Edit Profile')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('adminProfileEditSubmit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            {{-- <img src="{{ asset('admin/uploads/'.Auth::user()->avtar) }}" alt="" class="profile-photo w_100_p"> --}}
                            <img src="{{ asset('admin/uploads/'.Auth::guard('admin')->user()->avtar) }}" alt="" class="profile-photo w_100_p">
                            <input type="file" class="form-control mt_10" name="avtar">
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Retype Password</label>
                                <input type="password" class="form-control" name="retype_password" value="">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"></label>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@include('admin.layout.footerscripts')
</body>
</html>