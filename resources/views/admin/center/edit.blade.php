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
		<h1 class="h4 text-gray-900 mb-4">Cập nhật thông tin trung tâm</h1>
	  </div>
      <form class="user" method="POST" action="{{ route('center.update', ['id'=>$center->id]) }}">
        @csrf
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleFirstName">Tên</label>
			<input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="Name" value="{{$center->name}}">
		  </div>
		</div>
		<div class="form-group">
            <label for="exampleInputguilde">Giới thiệu</label>
		  <textarea type="email" class="form-control form-control-user" name="description" id="exampleInputguilde">{{$center->description}}</textarea>
		</div>
		<div class="form-group">
            <label for="exampleInputEmail">Email</label>
		  <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address" value="{{$center->email}}">
		</div>
		<div class="form-group row">
		  <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="exampleInput">Địa chỉ</label>
			<input type="text" class="form-control form-control-user" name="address" id="exampleInput" placeholder="Address" value="{{$center->address}}">
		  </div>
		  <div class="col-sm-6">
              <label for="exampleRepeatPassword">phone</label>
			<input type="text" class="form-control form-control-user" name="phone" id="exampleRepeatPassword" placeholder="Phone" value="{{$center->phone}}">
		  </div>

		</div>
		<input class="btn btn-primary btn-user btn-block" type="submit" value="Cập nhật">

		<hr>
	  </form>
	</div>
  </div>
@endsection
