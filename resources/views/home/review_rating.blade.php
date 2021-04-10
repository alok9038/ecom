@extends('layouts.base')
@section('content')
<style>
    
.rating {
  display: flex;
  width: 100%;
  /* justify-content: start; */
  overflow: hidden;
  flex-direction: row-reverse;
  height: 40px;
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 29px;
  height: 29px;
  /* margin-top: auto; */
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

.feedback {
  max-width: 150px;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  /* align-items: center; */
}

</style>
    <div class="container-fluid my-4">
        <div class="top-box d-flex bg-white p-3 shadow-sm">
            <h4>Ratings & Reviews</h4>
            <div class="ms-auto d-flex">
                <img src="{{ asset('product/'.$product->cover_image) }}" style="height: 38px; width:38px" alt="{{ $product->cover_image }}" class="img-fluid bg-dark round-10">
                <h6 class="small mt-2">{{ $product->title }}</h6>
            </div>
        </div>
        <div class="bottom-box mt-3">
            <div class="row g-3">
                <div class="col-lg-4 d-lg-flex d-md-flex d-none">
                    <div class="card border-0  shadow-sm rounded-0">
                        <div class="card header p-3 border-0 bg-white">
                            <h6 class="text-center h5">What makes a good review</h6>
                        </div>
                        <div class="card-body border-top p-3">
                            <div class="border-bottom p-3">
                                <h6>Have you used this product?</h6>
                                <p>Your review should be about your experience with the product.</p>
                            </div>
                            <div class="border-bottom p-3">
                                <h6>Why review a product?</h6>
                                <p>Your valuable feedback will help fellow shoppers decide!</p>
                            </div>
                            <div class="mb-4 p-3">
                                <h6>How to review a product?</h6>
                                <p>Your review should include facts. An honest opinion is always appreciated. If you have an issue with the product or service please contact us from the help centre.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    @if (!empty($rating))
                    <form action="{{ route('home.rating.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-0 shadow-sm rounded-0">
                            <div class="card-header p-4 bg-white">
                                <h6>Rate this Product </h6>
                                <div class="feedback m-0 p-0">
                                    <div class="rating m-0 p-0">
                                      <input type="radio" name="rating" @if($rating->ratings == 5) checked @endif value="5" id="rating-5">
                                      <label for="rating-5"></label>
                                      
                                      <input type="radio" name="rating" @if($rating->ratings == 4) checked @endif value="4" id="rating-4">
                                      <label for="rating-4"></label>
                                      
                                      <input type="radio" name="rating" @if($rating->ratings == 3) checked @endif value="3" id="rating-3">
                                      <label for="rating-3"></label>
                                      
                                      <input type="radio" name="rating" @if($rating->ratings == 2) checked @endif value="2" id="rating-2">
                                      <label for="rating-2"></label>
                                      
                                      <input type="radio" name="rating" @if($rating->ratings == 1) checked @endif value="1" id="rating-1">
                                      <label for="rating-1"></label>
                                    </div>
                                  </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="card-body p-4">
                                <h6>Review this product</h6>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" id="" cols="30" rows="7" class="form-control shadow-none rounded-0" placeholder="  Description..">{{ $rating->review_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Title <span class="small">(optional)</span></label>
                                    <input type="title" name="title" placeholder="Review title..." value="{{ $rating->review_title }}"   class="form-control rounded-0 shadow-none">
                                </div>
                                <div class="mb-3">
                                    <label>Screentshots</label>
                                    <input type="file" name="title" placeholder="  Review title..." class="form-control rounded-0 shadow-none">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Submit" class="btn btn-success float-end px-4 py-2 rounded-0 shadow-none">
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    @if (count($order) > 0)
                    <form action="{{ route('home.rating.insert') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-0 shadow-sm rounded-0">
                            <div class="card-header p-4 bg-white">
                                <h6>Rate this Product </h6>
                                <div class="feedback m-0 p-0">
                                    <div class="rating m-0 p-0">
                                      <input type="radio" name="rating" value="5" id="rating-5">
                                      <label for="rating-5"></label>
                                      
                                      <input type="radio" name="rating" value="4" id="rating-4">
                                      <label for="rating-4"></label>
                                      
                                      <input type="radio" name="rating" value="3" id="rating-3">
                                      <label for="rating-3"></label>
                                      
                                      <input type="radio" name="rating" value="2" id="rating-2">
                                      <label for="rating-2"></label>
                                      
                                      <input type="radio" name="rating" value="1" id="rating-1">
                                      <label for="rating-1"></label>
                                    </div>
                                  </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="card-body p-4">
                                <h6>Review this product</h6>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" id="" cols="30" rows="7" class="form-control shadow-none rounded-0" placeholder="  Description.."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Title <span class="small">(optional)</span></label>
                                    <input type="title" name="title" placeholder="  Review title..." class="form-control rounded-0 shadow-none">
                                </div>
                                <div class="mb-3">
                                    <label>Screentshots</label>
                                    <input type="file" name="title" placeholder="  Review title..." class="form-control rounded-0 shadow-none">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Submit" class="btn btn-success float-end px-4 py-2 rounded-0 shadow-none">
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                        <div class="card border-0 rounded-0 " style="height: 400px;">
                            <div class="card-body pt-5">
                                <h1 class="text-center">
                                    <img src="{{ asset('assets/images/error_404.png') }}" alt="" class="img-fluid"> <br>
                                    Haven't purchased this product?</h1>
                                <h6 class="text-muted text-center">Sorry! You are not allowed to review this product since you haven't bought it.</h6>
                            </div>
                        </div>
                    @endif
                    @endif                    
                </div>
                <div class="col-lg-4 d-lg-none d-md-none d-flex">
                    <div class="card border-0  shadow-sm rounded-0">
                        <div class="card header p-3 border-0 bg-white">
                            <h6 class="text-center h5">What makes a good review</h6>
                        </div>
                        <div class="card-body border-top p-3">
                            <div class="border-bottom p-3">
                                <h6>Have you used this product?</h6>
                                <p>Your review should be about your experience with the product.</p>
                            </div>
                            <div class="border-bottom p-3">
                                <h6>Why review a product?</h6>
                                <p>Your valuable feedback will help fellow shoppers decide!</p>
                            </div>
                            <div class="mb-4 p-3">
                                <h6>How to review a product?</h6>
                                <p>Your review should include facts. An honest opinion is always appreciated. If you have an issue with the product or service please contact us from the help centre.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection