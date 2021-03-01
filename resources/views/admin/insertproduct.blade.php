@extends('layouts.adminbase')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                
                <div class="card rounded-0">
                    <div class="card-header rounded-0">Insert Product</div>
                    <div class="card-body">
                        <form action="{{ route('insert.product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control text-capitalize rounded-0 shadow-none">
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="">Price</label>
                                    <input type="text" name="price" class="form-control text-capitalize rounded-0 shadow-none">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">Discount Price</label>
                                    <input type="text" name="discount_price" class="form-control text-capitalize rounded-0 shadow-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Category</label>
                                <select name="category" id="" class="form-control rounded-0 shadow-none">
                                    <option value="" selected hidden disabled>Select Category</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->cat_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="">Brand</label>
                                    <input type="text" name="brand" class="form-control rounded-0 text-capitalize shadow-none">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">model</label>
                                    <input type="text" name="model" class="form-control rounded-0 text-capitalize shadow-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="7" class="form-control text-capitalize rounded-0 shadow-none"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Cover Image</label>
                                <input type="file" name="cover_image" class="form-control rounded-0 shadow-none">
                            </div>
                            <div class="mb-3">
                                <label for="">Multi_Image</label>
                                <input type="file" name="images[]" multiple class="form-control rounded-0 shadow-none">
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Insert" class="btn btn-info w-100 rounded-0 shadow-none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection