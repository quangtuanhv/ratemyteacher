@extends('admin.wrapper')
@section('content')
<div class="col-lg-7">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
	<div class="p-5">
	  <div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Cập nhật đánh giá</h1>
	  </div>
      <form class="user" method="POST" action="{{ route('review.update', ['id'=>$review->id]) }}">
        @csrf
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="">Tên người đánh giá</label>
                <span class="d-block">{{$review->user->name}}</span>
		  </div>
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="">Tên người giáo viên</label>
                <span class="d-block">{{$review->teacher->name}}</span>
          </div>
          </div>

		<div class="form-group mt-3">
            <label for="exampleInputEmail">Tiêu đề</label>
		  <input class="form-control form-control-user" name="name" id="exampleInputEmail" value="{{$review->name}}">
		<div class="form-group mt-3">
            <label for="exampleInputEmail">Nội dung</label>
		  <textarea class="form-control form-control-user" name="description" id="exampleInputEmail">{{$review->description}}</textarea>
		</div>
		<input class="btn btn-primary btn-user btn-block" type="submit" value="Cập nhật">

		<hr>
	  </form>
	</div>
  </div>
@endsection
