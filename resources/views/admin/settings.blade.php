@extends('layouts.adminbase')
@section('content')
<style>
    .nav-item .active{
        background: #37474f!important;
    }
    .bg-theme-2{
        background: #37474f!important;
    }
</style>

    <div class="container">
        <ul class="nav nav-pills mb-1 bg-theme p-2" id="pills-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Site</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-light" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-light" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="card border-0 text-dark rounded-0">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col h4 pt-3">Logo :</div>
                            <div class="col-5"><div class="shadow-sm d-inline-flex p-3 bg-theme-2" style="border-radius:5px;"><img src="{{ asset('logo/'.site()->logo) }}" alt="" class="img-fluid"></div></div>
                            <div class="col-4 h4 "><div class="d-flex justify-content-end"><a href="" class="btn  btn-dark" data-toggle="modal" data-target="#logo"><i class="fa fa-edit"></i></a></div></div>
                        </div>
                        <hr>
                        <div class="row mb-3 pt-3">
                            <div class="col h4 ">Site Name :</div>
                            <div class="col-5 h4">{{ site()->site_name }}</div>
                            <div class="col-4 h4 "><div class="d-flex justify-content-end"><a href="" class="btn  btn-dark" data-toggle="modal" data-target="#site_name"><i class="fa fa-edit"></i></a></div></div>
                        </div>
                        <hr>
                        <div class="row pt-3">
                            <div class="col h4 mt-3">Theme Color :</div>
                            <div class="col-5 h4"><div class="p-3 px-4" style="height: 60px; width:150px;border-radius:5px; background-color:{{ site()->color }}">{{ site()->color }}</div></div>
                            <div class="col-4 h4 "><div class="d-flex justify-content-end"><a href="" class="btn  btn-dark" data-toggle="modal" data-target="#color"><i class="fa fa-edit"></i></a></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </div>
    <!-- Button trigger modal -->
>
  <div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 100px;" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <form action="{{ route('site.settings.update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <label for="">Logo</label>
                <input type="file" name="logo" class="form-control shadow-none">
                <div class="mt-3">
                    <input type="submit" name="update_logo" class="btn btn-info float-end shadow-none">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="site_name" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 100px;" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <form action="{{ route('site.settings.update') }}" method="post">
                @csrf
                <label for="">Site Name</label>
                <input type="text" value="{{ site()->site_name }}" name="site_name" class="form-control shadow-none">
                <div class="mt-3">
                    <input type="submit" name="update_site_name" class="btn btn-info float-end shadow-none">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="color" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 100px;" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <form action="{{ route('site.settings.update') }}" method="post">
                @csrf
                <label for="">Theme Color</label>
                <input type="color" value="{{ site()->color }}" name="color" class="form-control shadow-none">
                <div class="mt-3">
                    <input type="submit" value="Update Theme Color" name="update_color" class="btn btn-info float-end shadow-none">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection