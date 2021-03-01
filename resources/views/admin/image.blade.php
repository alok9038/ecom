@extends('layouts.adminbase')
@section('content')
    <div class="container">
        <form action="{{ route('insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="">Images</label>
                <input type="file" name="image[]" multiple class="form-control rounded-0">
            </div>
            <input type="submit" value="add" class="btn btn-info rounded-0">
        </form>
    </div>
@endsection