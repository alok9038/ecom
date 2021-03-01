@extends('layouts.adminbase')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('insert.category') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label >Category Title</label>
                                <input type="text" id="title" name="title" class="form-control rounded-0 shadow-sm">
                            </div>
                            <div class="mb-3">
                                <label >Description</label>
                                <textarea  class="form-control" name="description" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label >Image</label>
                                <input type="file" name="image" class="form-control rounded-0 shadow-sm">
                            </div>
                            <div class="mb-3">
                                <label >Color <span class="text-muted">(Optional)</span></label>
                                <input type="color" name="color" class="form-control rounded-0 shadow-sm">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-info rounded-0 w-100" name="add_cat" value="Insert Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <form action="" class="d-flex">
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn bg-white rounded-0 text-dark border-0"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="search" name="search" id="" class="form-control rounded-0 shadow-none bg-white border-0 text-dark" placeholder="search Category">
                                    </div>
                                </form>
                            </div>
                            <div class="col-4"><a href="#title" class="btn btn-info float-end rounded-0 btn-sm">Add Category</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <tr class="table-dark">
                                <th >Sr no</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $sr = 0
                            @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $sr +=1 }}</td>
                                    <td>{{ $category->cat_title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="d-flex">
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-danger rounded-0 btn-sm"><i class="fa fa-trash"></i></a>
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-info rounded-0 btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" style="margin-top:100px; " role="document">
          <div class="modal-content rounded-0">
            <div class="modal-body rounded-0">
                <h2 class="text-center"><i class="fa fa-exclamation-circle fa-3x text-warning"></i></h2>
                <h4 class="text-center text-dark h2 fw-light">Are You Sure?</h4>
                <div class="d-flex mx-auto mt-4 justify-content-center">
                    <form action="{{ route('category.delete',['id'=>$category->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-info rounded-0 "><i class="fa fa-check"></i> Yes, delete it!</button>
                    </form>
                    <button type="button" class="close rounded-0 btn btn-danger ms-3" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                </div>
            </div>
            
          </div>
        </div>
      </div>
@endsection